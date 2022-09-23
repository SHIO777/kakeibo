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
    // 家計簿を入力するページ
    Route::resource('transaction', TransactionController::class);
    // 所得と支出のカテゴリーを追加するページ
    Route::resource('category', CategoryController::class);
    // 所得か支出の種類
    Route::resource('kind', KindController::class);
    // chartjs page
    Route::get('/chartjs', function() {return view('chartjs');});

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
