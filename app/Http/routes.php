<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::get('qiniu', 'HomeController@qiniu');
Route::resource('/uptoken', 'HomeController');

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'HomeController@index');
    Route::post('/uploadImage', 'VideoController@uploadImage');
//    Route::post('video/upload', 'VideoController@upload');
    Route::resource('video', 'VideoController');
    Route::resource('bucket', 'BucketController');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('alipay', 'AlipayController');
//支付宝支付处理
//Route::get('alipay/pay','AlipayController@pay');
////支付后跳转页面
//Route::post('alipay/return','AlipayController@result');

Route::resource('/videoDetail', 'VideoDetailController');
