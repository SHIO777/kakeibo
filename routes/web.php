<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KindController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function(){
    // 分析ページ
    Route::get('transaction/analyze', [TransactionController::class, 'mydata'])->name('transaction.analyze');   // analyze page UI
    // 分析ページで非同期通信するときに使用
    // Route::post('/transaction/postdata', [TransactionController::class, 'postdata'])->name('transaction.postdata'); // post
    // Route::get('/transaction/getdata', [TransactionController::class, 'getdata'])->name('transaction.getdata'); // get
    
    // 家計簿を入力するページ
    Route::resource('transaction', TransactionController::class);
    // 所得と支出のカテゴリーを追加するページ
    Route::resource('category', CategoryController::class);
    // 所得か支出の種類
    Route::resource('kind', KindController::class);
    // Route::post('/post/kind', AjaxController@getCategory)->name('post.getCategory');
    // chartjs page
    // Route::get('/chartjs', function() {return view('chartjs');});
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chartjs', function() {return view('chartjs');});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
