<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

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

Route::get('/', ['as' => 'homepage', 'uses' => 'HomeController@index']);
Route::get('register/verify/{token}', 'Auth\RegisterController@verify');

Route::get('/logout', ['as' => 'user.logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('/home', function () {
    return redirect()->route('url_create');
})->middleware('auth')->name('home');

/*
 * admin routes
 */
Route::group([
    'prefix' => '/admin',
    'middleware' => ['auth'],
], function () {
    Route::resource('links', 'admin\LinksController', [
        'names' => [
            'index' => 'admin.links.index',
            'show' => 'admin.links.show',
        ]
    ]);
    Route::resource('users', 'admin\UsersController', [
        'names' => [
            'index' => 'admin.users.index',
            'edit' => 'admin.users.edit',
            'create' => 'admin.users.create',
            'destroy' => 'admin.users.destroy',
            'update' => 'admin.users.update',
            'store' => 'admin.users.store',
        ]
    ]);
    Route::get('/', 'admin\DashboardController@index')->name('admin.dashboard.index');
});

/*
 * User Dashboard
 */
Route::group([
    'prefix' => '/dashboard',
    'middleware' => ['auth'],
], function () {
    Route::resource('links', 'UserDashboardController');
});

/*
 * Setup auth routes
 */
Auth::routes();

Route::get('create', 'SystemController@create')->name('url_create');
Route::post('create', 'SystemController@store')->name('url_store');

/*
 * Note. This should be the last url ever in this routes file.
 */
Route::get('/{linkHash}', 'SystemController@show');
