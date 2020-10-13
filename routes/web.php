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

Route::get('/', function () {
    return view('welcome');
});

Route::get('index','\App\Http\Controllers\AddController@index')->name('index');

Route::get('index','\App\Http\Controllers\AddController@add')->name('task.add');
Route::post('index','\App\Http\Controllers\AddController@create');

Route::get('index{id?}','\App\Http\Controllers\AddController@edit')->name('index.edit');
Route::post('index{id?}','\App\Http\Controllers\AddController@update')->name('index.edit');

Route::post('task/destroy{id?}','\App\Http\Controllers\AddController@destroy')->name('index.destroy');
