<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/analyze', 'HomeController@show')->name('analyze')->middleware('auth');


// function () {
//     return view('pages.home',['teste'=>'iurii ']);
// })->middleware('auth');

Route::get('/transaction/1', 'Transaction@insert')->middleware('auth');
Route::get('/transaction', 'Transaction@show')->middleware('auth');
Route::post('/transaction', 'Transaction@show')->name('transaction.store')->middleware('auth');

