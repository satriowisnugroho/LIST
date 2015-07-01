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

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::controller('auth', 'LoginController');
Route::post('register', [
	'as' => 'register',
	'uses' => 'UserController@register'
]);
Route::post('reset', [
	'as' => 'reset',
	'uses' => 'UserController@resetLink'
]);
Route::get('reset/{token}', 'UserController@resetForm');
Route::post('reset/password', 'UserController@resetPassword');
Route::get('books/{category}', 'BookController@category');
Route::get('books/detail/{id}', 'BookController@detail');
Route::get('search/{query}', 'BookController@search');
Route::get('search', function(){
	return '<div id="searching"><ul><li>Ketikkan sesuatu</li></ul></div>';
});
Route::get('books/category/query/{query}', 'BookController@categoryQuery');
Route::get('test', 'BookController@json');

Route::get('login', ['uses' => 'LoginController@index', 'middleware' => 'login']);

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function()
{

	Route::get('/', 'AdminController@index');
	Route::resource('users', 'UserController');
	Route::get('profile', 'UserController@editProfile');

	Route::put('profile/update/{id}', [
		'as' => 'profile.admin',
		'uses' => 'UserController@updateProfile'
	]);

	Route::resource('books', 'BookController');
	Route::get('users/reset/{id}', 'UserController@reset');

});



Route::group(['middleware' => 'operator', 'prefix' => 'operator'], function()
{

	Route::get('/', [
		'as' => 'op',
		'uses' => 'OperatorController@index'
	]);
	Route::resource('users', 'UserController');
	Route::get('profile', 'UserController@editProfile');

	Route::put('profile/update/{id}', [
		'as' => 'profile.operator',
		'uses' => 'UserController@updateProfile'
	]);

	Route::get('users/reset/{id}', 'UserController@reset');
	Route::resource('borrow', 'BorrowController');
	Route::resource('books', 'BookController');
	Route::get('order', 'OrderController@index');
	Route::get('order/{id}', 'OrderController@process');
	Route::resource('transactions', 'TransactionController');

});



Route::group(['middleware' => 'member'], function()
{

	Route::get('books/order/{id}', [
		'as' => 'order',
		'uses' => 'OrderController@order'
	]);

	Route::put('/profile/update/{id}', [
		'as' => 'profile.member',
		'uses' => 'UserController@updateName'
	]);

	Route::put('users/{id}', 'UserController@updateProfile');

});

Route::get('image/{id}', function($id) {
	$book = App\Book::find($id);
	$img = Image::make(asset('images/cover/'.$book->cover))->resize(268, 249);
	return $img->response('jpg');
});
