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

Route::get('/', 'PodcastController@index');

Route::group(['prefix' => 'podcast'], function() {
	Route::get('player', 'PodcastController@index');
	Route::get('manage', 'PodcastController@manage');
	Route::get('manage_categories', 'PodcastController@manageCategories');
	Route::get('favorites', 'PodcastController@favorites');
	Route::get('settings', 'PodcastController@settings');
	Route::post('add', 'PodcastController@add');
	Route::post('add_category', 'PodcastController@addCategory');
	Route::post('assign_category', 'PodcastController@assignCategory');
	Route::post('delete', 'PodcastController@delete');
});

Route::group(['prefix' => 'user'], function() {
	Route::get('manage_categories', 'UserController@manageCategories');
});

Route::get('podcast/auto-update', function () {
	$exitCode = \Artisan::call('updatePodcastItems');
	if ($exitCode == 0) {
		return redirect('podcast/player');
	}
});

Route::get('item/search', 'ItemController@search');
Route::post('item/mark-as-read', 'ItemController@markAsRead');
Route::post('item/mark-as-favorite', 'ItemController@markAsFavorite');
Route::post('item/mark-all-prev-read', 'ItemController@markAllPrevAsRead');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
