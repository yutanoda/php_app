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
Route::get('/top', 'TuserController@topPage')->name('top');
Route::post('/login', 'TuserController@login')->name('login');
Route::post('/update_content', 'TuserController@updateContent')->name('update_content');
Route::get('/logout', 'TuserController@logout')->name('logout');
