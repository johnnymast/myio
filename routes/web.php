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

/**
 * Admin routes
 */
Route::group([
    'prefix'     => '/admin',
    'middleware' => ['auth']
], function () {
    //LinksController
    //UsersController
});

/**
 * User Dashboard
 */
Route::group([
    'prefix'     => '/dashboard',
    'middleware' => ['auth']
], function () {
    Route::resource('links', 'UserDashboardController');
});


/**
 * Setup auth routes
 */
Auth::routes();

Route::get('/home', 'HomeController@index');
