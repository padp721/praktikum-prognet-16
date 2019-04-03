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

// Route::get('/', function (){
//     return view('welcome');
// });

// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/','ShopController@index')->name('index');
Route::get('/user/logout','Auth\LoginController@logoutUser')->name('user.logout');

Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminAuth\LoginController@doLogin')->name('admin.login.submit');
    Route::get('/logout','AdminAuth\LoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    Route::resource('/user','Admin\AdminUserController', [
        'names' => [
            'index' => 'admin.user'
        ]
    ]);

    Route::resource('/courier','Admin\AdminCourierController', [
        'names' => [
            'index' => 'admin.courier'
        ]
    ]);

    Route::resource('/transaction','Admin\AdminTransactionController', [
        'names' => [
            'index' => 'admin.transaction'
        ]
    ]);
    
});
