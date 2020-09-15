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

Auth::routes();

// ゲスト状態
Route::get('/','HistoriesController@home');
// ログイン状態
Route::group(['middleware' => 'auth'], function() {
    Route::get('/login_completed', 'HomeController@index')->name('home');
    Route::post('/record_completed', 'HistoriesController@add');
    Route::get('/index', 'HistoriesController@index')->name('index');
    Route::get('/edit', 'HistoriesController@edit')->name('edit');
    Route::post('/update_completed', 'HistoriesController@update')->name('update');
    Route::get('/delete', 'HistoriesController@delete');
});




