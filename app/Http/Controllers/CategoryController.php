<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use App\Models\Kind;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::getAllOrderByUpdated_at();
        // categoryをアルファベット順に並び替えたのち，kind_id順に並びかえpaymentとincomeに分ける
        $categories = Category::all()->sortBy('category')->sortBy('kind_id');
        // ddd($categories);
        // compactがないとerror: compactは，controllerからviewに渡すための関数
        return view('category.index', compact('categories'));
        // ddd(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // PaymentかIncomeを選択するために，kinds tableから情報を取得
        $kinds = Kind::getAllOrderByUpdated_at();
        // ddd($kinds);
        return view('category.create', compact('kinds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        // dd($request);
        $validator = Validator::make($request->all(), [
            'kind_id' => 'required',
            'category' => 'required',
            'description' => 'required | max:200',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('category.create')
            ->withInput()
            ->withErrors($validator);
        }
        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
        $result = Category::create($request->all());
        // ルーティング「category.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
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
        //バリデーション
        $validator = Validator::make($request->all(), [
            'kind_id' => 'required',
            'category' => 'required',
            'description' => 'required | max:100',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('category.edit', $id)
            ->withInput()
            ->withErrors($validator);
        }
        //データ更新処理
        $result = Category::find($id)->update($request->all());
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Category::find($id)->delete();
        return redirect()->route('category.index');
    }
}
