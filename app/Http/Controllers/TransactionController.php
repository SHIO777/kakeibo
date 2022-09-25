<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            // ->get();     // get() doesn't need
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
}
