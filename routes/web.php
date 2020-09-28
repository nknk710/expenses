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
    Route::post('/record_completed', 'HistoriesController@add')->name('add');
    Route::get('/month_index', 'HistoriesController@month_index')->name('month_index');
    Route::get('/year_index', 'HistoriesController@year_index')->name('year_index');
    Route::post('/edit', 'HistoriesController@edit')->name('edit');
    Route::post('/update_completed', 'HistoriesController@update')->name('update');
    Route::get('/delete', 'HistoriesController@delete')->name('delete');
});




