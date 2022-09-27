<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\Transaction;
use App\Models\Kind;
use App\Models\Category;
use App\Models\User;
use Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = User::query()
            ->find(Auth::user()->id)
            ->userTransactions()
            ->orderByDesc('date')       // 買い物した日付（date）順で並び替える
            ->orderByDesc('created_at') // 作成された順に並べる
            ->with('kind')              // eager loading for preventing lazy loading
            ->with('category')
            ->paginate(10);
        // ddd($transactions);
        return view('transaction.index', compact(['transactions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::all()->sortBy('category')->sortBy('kind_id');
        $categories = Category::all()->sortBy('id');

        // categoryのarrayを作成
        // $categories_array = array();
        // foreach($categories as $category) {
        //     $categories_array[] = $category->category;
        // };
         
        $categories_data = Category::select('id', 'kind_id', 'category')->get();
        // ddd($categories_data);
        // $categories_json = json_encode($categories_data);
        $categories_json = $categories_data->toJson();
        // ddd($categories_json);

        $kinds = Kind::all()->sortBy('id');
        
        return view('transaction.create', compact(['kinds', 'categories', 'categories_json']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        // Kindとcategoryの整合性がとれているか確認
        $arrowCategory = array();

        // ddd($request->kind_id);     // "2"
        // ddd(gettype($request->kind_id)); // -> string
        // ddd(gettype((int)$request->kind_id)); // -> integer
        // ddd($request->all()['kind_id']);

        $categories = Category::where('kind_id', '=', $request->all()['kind_id'])->get();
        // ddd($categories);
        foreach($categories as $category) {
            // ddd($category->id);
            $arrowCategory[] = $category->id;
        };
        // ddd(in_array(15, $arrowCategory));       // if kind_id = 2 -> true
        
        $request['allow category array'] = $arrowCategory;
        $validator = Validator::make($request->all(), [
            'kind_id' => 'required',
            'category_id' => 'required|in_array:allow category array.*',
            'price' => 'required',
            'date' => 'required',
            'place' => 'max:100',
            'note' => 'max:100',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('transaction.create')
            ->withInput()
            ->withErrors($validator);
        }

        // user_idをマージし，DBにinsertする
        $data = $request->merge(['user_id' => Auth::user()->id])->all();

        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
        $result = Transaction::create($data);
        // ルーティング「category.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
        $kind = Kind::find($transaction->kind_id);
        $category = Category::find($transaction->category_id);
        // ddd($transaction);
        // ddd($transaction->all()->kind_id);
        return view('transaction.show', compact(['transaction', 'kind', 'category']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::find($id);
        $kinds = Kind::all()->sortBy('id');
        $categories = Category::all()->sortBy('id');

        // create()と同じ
        $categories_data = Category::select('id', 'kind_id', 'category')->get();
        $categories_json = $categories_data->toJson();

        // $category = Category::find($transaction->category_id);
        return view('transaction.edit', compact(['transaction', 'kinds', 'categories', 'categories_json']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // kindとcategoryの組み合わせが正しいかvalidation
        $arrowCategory = array();
        $categories = Category::where('kind_id', '=', $request->all()['kind_id'])->get();
        foreach($categories as $category) {
            $arrowCategory[] = $category->id;
        };
        $request['allow category array'] = $arrowCategory;

        $validator = Validator::make($request->all(), [
            'kind_id' => 'required',
            'category_id' => 'required|in_array:allow category array.*',
            'price' => 'required',
            'date' => 'required',
            'place' => 'max:100',
            'note' => 'max:100',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('transaction.edit', $id)
            ->withInput()
            ->withErrors($validator);
        }

        // user_idをマージし，DBにinsertする
        $data = $request->merge(['user_id' => Auth::user()->id])->all();

        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
        $result = Transaction::find($id)->update($request->all());
        // ルーティング「category.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Transaction::find($id)->delete();
        return redirect()->route('transaction.index');
    }

    public function mydata()
    {
        $weeks = 1;
        // 今日を -0 weeksとする．
        $start_week = date('YW', strtotime("-{$weeks} weeks"));
        $start_time = strtotime(date('Y\WW', strtotime("-{$weeks} weeks")));
        // ddd(date('Y\WW', strtotime("-{$weeks} weeks")));    // "2022W38"
        
        // Userモデルに定義したリレーションを使用してデータを取得する
        // 日々の収入支出の合計をカテゴリー別に算出
        // $transactions = User::query()
        //     ->find(Auth::user()->id)
        //     ->userTransactions()
        //     ->orderByDesc('date');
            // ->get()
            // ->groupBy('date')
            // ->map(function ($day) {
            //     return $day -> sum('price');
            // });

        // SQL
        // // ハイフンは``で囲む. sum(*)とはできない．必ずカラム名を指定する
        // // week 作ってユーザーでtransaction絞って，探すユーザーに対応するtransaction idを確認する
        // select id, yearweek(date, 2) as week, user_id, kind_id, category_id, price, date from transactions where user_id in (6);
        // // 取得したtransaction idでtransaction dataを絞る
        // select yearweek(date, 2) as week, price from  transactions where id in (2, 3, 5, 7);
        // // week ごとにpriceを合計する．
        // select yearweek(date, 2) as week, sum(price) from  transactions where id in (2, 3, 5, 7) group by week;
        // Tinker
        // Transaction::select(DB::raw('YEARWEEK(date, 2) AS week'), 'id', 'user_id', 'kind_id', 'category_id', 'price', 'date')->where('user_id', 6)->pluck('id');
        
        // ddd($start_week);
        $user_id = Auth::user()->id;
        $yearweek = date('Y\WW', strtotime("-$weeks weeks"));
        $date_of_Monday = date('Y-m-d', strtotime($yearweek));
        // Sunday 始まりにする
        $start_date = date('Y-m-d', strtotime($date_of_Monday. '-1 day'));
        $end_date = date('Y-m-d', strtotime($date_of_Monday. '+5 day'));
        // ddd($start_date, $end_date);

        // userのtransactions取得
        $transaction_ids = Transaction::select('id', 'user_id')->where('user_id', $user_id)->pluck('id');
        // 期間にあるtransactionを取得
        // whereInの引数('id', [0, 1, 2])は，[]で囲むこと
        $transactions = Transaction::select('id', 'date')->whereBetween('date', [$start_date, $end_date])->get();
        ddd($transactions);


        // $transactions = Transaction::select('id', DB::raw('YEARWEEK(date, 2) AS week'))->DB::raw('where week in ($start_week)')->get();
        $transactions = Transaction::select('id', DB::raw('YEARWEEK(date, 2) AS week'))->get();




        $transactions2 = $transactions -> whereIn('week', [202238])->pluck('week', 'id');
            // ->whereIn('week', $start_week)->get();
        


        $transactions = Transaction::select(DB::raw('YEARWEEK(date, 2) AS week'), DB::raw('sum(price) AS price'))
            // ->whereIn('id', $transaction_ids)
            ->having('week=', [$start_week])
            ->groupBy('week')
            ->pluck('week', 'price')
            ->toArray();

        ddd($transactions);
        $filled_result = [];
        for ($i = $weeks; $i>=1; $i--) {
            $week = date('YW', strtotime("-$i weeks"));
            $date = date('Y-m-d', strtotime("-$i weeks"));
            $filled_result[$data] = isset($result[$week]) ? $result[$week] : 0;
        }

        


        $transactions_json = $transactions->toJson();
        // $categories = Category::all()->sortBy('id');
        $payment_categories = Category::where('kind_id', '=', 1)->get();
        $income_categories = Category::where('kind_id', '=', 2)->get();

        return view('transaction.analyze', compact(['transactions_json', 'payment_categories', 'income_categories']));
    }

    public function getdata()
    {
        // Userモデルに定義したリレーションを使用してデータを取得する
        // 日々の収入支出の合計を算出
        $transactions = User::query()
            ->find(Auth::user()->id)
            // ->find(6)
            ->userTransactions()
            ->orderBy('date')
            ->get()
            ->groupBy('date')
            ->map(function ($day) {
                return $day -> sum('price');
            });
        $transactions_json = $transactions->toJson();
        return $transactions_json;
    }

    public function postdata(Request $request)
    {
        $result = $request -> all();
        return $result;

        // Userモデルに定義したリレーションを使用してデータを取得する
        // 日々の収入支出の合計を算出
        // $transactions = User::query()
        //     ->find(Auth::user()->id)
        //     // ->find(6)
        //     ->userTransactions()
        //     ->orderBy('date')
        //     ->get()
        //     ->groupBy('date')
        //     ->map(function ($day) {
        //         return $day -> sum('price');
        //     });
        // $transactions_json = $transactions->toJson();
        // return $transactions_json;
    }


    
}
