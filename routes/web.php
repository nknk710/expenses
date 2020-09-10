<?php

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
    return view('home');
});

Auth::routes();


// ゲスト状態
// Route::get('/','QuestionController@home')->name('home');
// ログイン状態
Route::group(['middleware' => 'auth'], function() {
    Route::get('/login_completed', 'HomeController@index')->name('home');
    Route::post('/record_completed', 'HistoriesController@add');    
});




