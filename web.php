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

use App\User;
use App\Device;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/devices', ['as' => 'device', function () {

		$devices = Device::where('user_id', Auth::id())->get();
		$users = User::where('post', 'Maintainer')->get();
		return view('device', compact('devices', 'users'));
		
	}]);

	Route::post('/complaint/{id}', 'ComplaintController@create');
	Route::post('/delete/{id}', 'ComplaintController@delete');
	Route::get('/complaints', 'ComplaintController@show');
	Route::post('/feedback/{id}', 'ComplaintController@update');
	Route::get('/report', 'ComplaintController@report');

});