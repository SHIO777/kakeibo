<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Transaction;
use App\Models\Kind;
use App\Models\Category;
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
        // 買い物した日付（date）順で並び替える
        $transactions = Transaction::all()->sortBy('date');
        return view('transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // kinds, categories
        $kinds = Kind::all()->sortBy('id');
        $categories = Category::all()->sortBy('category')->sortBy('kind_id');
        return view('transaction.create', compact(['kinds', 'categories']));
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
        $validator = Validator::make($request->all(), [
            'kind_id' => 'required',
            'category_id' => 'required',
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
        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
        $result = Transaction::create($request->all());
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
        $transaction = Transaction::find($id);
        return view('transaction.show', compact('transaction'));
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
        return view('transaction.edit', compact('transaction'));
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
        $validator = Validator::make($request->all(), [
            'kind_id' => 'required',
            'category_id' => 'required',
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
