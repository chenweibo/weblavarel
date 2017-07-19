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
    return view('welcome');
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



/*
|--------------------------------------------------------------------------
| chenweibo 2017-7-6 admin router create
|--------------------------------------------------------------------------
*/

Route::any('/jksm', 'Admin\LoginController@index')->name('jksm');
Route::get('/adminloginout', 'Admin\LoginController@loginout')->name('adminout');
Route::get('/error', 'Admin\AdminController@error')->name('error');


Route::group(['middleware' => ['adminbase','web'],'namespace' => 'Admin'], function () {
    Route::get('/admin', 'AdminController@index')->name('AdminIndex');
    Route::get('/adminmain', 'AdminController@indexPage')->name('adminmain');
    Route::any('/site', 'AdminController@site')->name('site');

// 2017-7-16 by chenweibo slide routes
Route::any('slide', 'AdminController@SlideIndex')->name('SlideIndex');
    Route::any('slide/create', 'AdminController@SlideCreate')->name('SlideCreate');
    Route::any('slide/edit', 'AdminController@SlideEdit')->name('SlideEdit');
    Route::any('slide/delete', 'AdminController@SlideDelete')->name('SlideDelete');
});
