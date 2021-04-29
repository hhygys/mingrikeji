<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//登录注销
Route::get('/login','UserController@Login');
Route::post('/login','UserController@DoLogin');
Route::get('/logout','UserController@Logout');

//后台页面路由
Route::controller('/adm/user','UserController');
Route::controller('/adm/news','NewsController');
Route::get('/adm',array('before'=>'auth','uses'=>'UserController@adminIndex'));
//Route::get('/adm','UserController@adminIndex');


//首页
Route::controller('/front', 'FrontController');
Route::get('/', 'FrontController@Index');
