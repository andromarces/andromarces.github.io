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

Route::get("/", "HomeController@index")->name("home");

// check email if exists in database
Route::post("checkEmail", "Auth\RegisterController@checkEmail");

// check username if exists in database
Route::post("checkUsername", "Auth\RegisterController@checkUsername");
