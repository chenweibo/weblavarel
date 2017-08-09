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
|------------------------------------------------------------------------------------------------------------------------------------
| chenweibo  admin router //警告下面路由勿动！！
|------------------------------------------------------------------------------------------------------------------------------------
*/
// 2017-8-3 by chenweibo common routes
Route::any('/jksm', 'Admin\LoginController@index')->name('jksm');
Route::get('/adminloginout', 'Admin\LoginController@loginout')->name('adminout');
Route::get('/error', 'Admin\AdminController@error')->name('error');
Route::any('/uploads', 'Admin\CommonController@uploads')->name('uploads');
Route::any('/weup', 'Admin\CommonController@weup')->name('weup');
Route::any('/ajaxState', 'Admin\CommonController@ajaxState')->name('ajaxState');
Route::any('/ajaxSort', 'Admin\CommonController@ajaxSort')->name('ajaxSort');
Route::any('/EditUploads', 'Admin\CommonController@EditUploads')->name('EditUploads');
Route::any('/delImg', 'Admin\CommonController@delImg')->name('delImg');
Route::any('/getcate', 'Admin\CommonController@getcate')->name('getcate');

// 2017-7-30 by chenweibo rewrite routes
Route::any('admin/common/rewrite', 'Admin\CommonController@rewrite')->name('rewrite');

Route::group(['middleware' => ['adminbase','web'],'namespace' => 'Admin'], function () {
    Route::get('/admin_index', 'AdminController@index')->name('AdminIndex');
    Route::get('/adminmain', 'AdminController@indexPage')->name('adminmain');
    Route::any('/site', 'AdminController@site')->name('site');

// 2017-7-16 by chenweibo slide routes

    Route::any('slide', 'AdminController@SlideIndex')->name('SlideIndex');
    Route::any('slide/create', 'AdminController@SlideCreate')->name('SlideCreate');
    Route::any('slide/edit', 'AdminController@SlideEdit')->name('SlideEdit');
    Route::any('slide/delete', 'AdminController@SlideDelete')->name('SlideDelete');

// 2017-7-16 by chenweibo user routes

    Route::any('admin/user', 'UserController@UserIndex')->name('UserIndex');
    Route::any('admin/user/create', 'UserController@UserCreate')->name('UserCreate');
    Route::any('admin/user/edit/{id?}', 'UserController@UserEdit')->name('UserEdit');
    Route::any('admin/user/delete', 'UserController@UserDelete')->name('UserDelete');

// 2017-7-26 by chenweibo role routes
    Route::any('admin/role', 'UserController@Role')->name('Role');
    Route::any('admin/role/create', 'UserController@RoleCreate')->name('RoleCreate');
    Route::any('admin/role/edit', 'UserController@RoleEdit')->name('RoleEdit');
    Route::any('admin/role/delete', 'UserController@RoleDelete')->name('RoleDelete');
    Route::any('admin/role/giveAccess', 'UserController@giveAccess')->name('giveAccess');

//   2017-7-26 by chenweibo comlum routes
    Route::any('admin/Comlums/index', 'ColumnController@Column')->name('Column');
    Route::any('admin/Comlums/create', 'ColumnController@ColumnCreate')->name('ColumnCreate');
    Route::any('admin/Comlums/edit', 'ColumnController@ColumnEdit')->name('ColumnEdit');
    Route::any('admin/Comlums/delete', 'ColumnController@ColumnDelete')->name('ColumnDelete');

//   2017-7-26 by chenweibo page routes
    Route::any('admin/page/index', 'ContentController@Page')->name('Page');
    Route::any('admin/page/edit', 'ContentController@PageEdit')->name('PageEdit');

//   2017-8-4 by chenweibo product routes
    Route::any('admin/product/{id?}/{keys?}', 'ContentController@Product')->name('Product');
    Route::any('admin/productCreate/', 'ContentController@ProductCreate')->name('ProductCreate');
    Route::any('admin/productEdit/', 'ContentController@ProductEdit')->name('ProductEdit');
    Route::any('admin/productEelete/', 'ContentController@ProductDelete')->name('ProductDelete');
    Route::any('admin/productMoredelete/', 'ContentController@ProductMoreDelete')->name('ProductMoreDelete');

  //   2017-8-8 by chenweibo mumber routes
    Route::any('admin/Member', 'MemberController@MemberIndex')->name('MemberIndex');
    Route::any('admin/Member/create', 'MemberController@MemberCreate')->name('MemberCreate');
    Route::any('admin/Member/edit/{id?}', 'MemberController@MemberEdit')->name('MemberEdit');
    Route::any('admin/Member/delete', 'MemberController@MemberDelete')->name('MemberDelete');

  //   2017-8-8 by chenweibo gbook routes
    Route::any('admin/gbook', 'GbookController@GbookIndex')->name('GbookIndex');
    Route::any('admin/gbook/edit/{id?}', 'GbookController@GbookEdit')->name('GbookEdit');
    Route::any('admin/gbook/delete', 'GbookController@GbookDelete')->name('GbookDelete');

  //   2017-8-9 by chenweibo recycle routes
    Route::any('admin/recycle', 'ContentController@RecycleIndex')->name('RecycleIndex');
    Route::any('admin/recycle/recover', 'ContentController@RecycleRecover')->name('RecycleRecover');
    Route::any('admin/recycle/delete', 'ContentController@RecycleDelete')->name('RecycleDelete');
});
