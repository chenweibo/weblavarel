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
Route::get('show/{id}.php', [function ($id) {
    return 2;
}]);
Route::get('show/{id}', [function ($id) {
    return 1;
}]);

Route::any('/jksm', 'Admin\LoginController@index')->name('jksm');
Route::group(['middleware' => ['adminbase','web'],'namespace' => 'Admin'], function () {

    Route::get('/admin', function () {
         return 11;
    });

});
