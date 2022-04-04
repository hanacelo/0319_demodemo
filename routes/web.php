<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\PostsController;//追記
use App\Http\Controllers\ImgController; //画像追加処理
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

Route::get('/', function () {
    return view('welcome');
});


//ログイン画面の表示
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//たぶんこっちが一覧画面の表示
Route::get('/', [PostsController::class, 'index']);

//本の登録処理
Route::post('posts', [PostsController::class, 'store']);

// 本の詳細
Route::get('/show/{id}', [PostsController::class, 'show'])->name('show');

//お気に入りの処理
Route::post('post/{post_id}', [PostsController::class, 'favo']);

//画像アップロード画面表示
Route::get('/img', [ImgController::class, 'index']);

//画像アップロード処理
Route::post('/img/upload',[ImgController::class, 'upload']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');