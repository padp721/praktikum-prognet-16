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
Route::get('/user/logout','Auth\LoginController@logoutUser')->name('user.logout');

//Test Raja Ongkir
Route::get('rajaongkir/getprovince','RajaOngkirController@getprovince');
Route::get('rajaongkir/getcity','RajaOngkirController@getcity');
Route::get('rajaongkir/checkshipping','RajaOngkirController@checkshipping');

// Shopping
Route::get('/','ShopController@index')->name('index');
Route::get('/product_list','ShopController@product_list')->name('user.product_list');
Route::get('/product/{product}','ShopController@product_detail')->name('user.product_detail');
Route::post('/product/{product}','ShopController@add_cart')->name('user.add_cart');
Route::get('/transactions','ShopController@transactions')->name('user.transactions');
Route::get('/transaction/{transaction}','ShopController@transaction_detail')->name('user.transaction_detail');
Route::post('transaction/{transaction}','ShopController@upload_pop')->name('user.upload_pop');
Route::patch('transaction/{transaction}','ShopController@recieve')->name('user.recieve');
Route::put('transaction/{transaction}','ShopController@cancel')->name('user.cancel');
Route::get('notifications/{notifications}','ShopController@read_notification')->name('user.notifications');

//Rating
Route::resource('/review', 'ReviewController', [
        'names' => [
            'index' => 'review.index'
        ]
    ]);

// Cart
Route::get('/cart','ShopController@view_cart')->name('user.view_cart');
Route::delete('/cart/{cart}','ShopController@delete_cart')->name('user.delete_cart');
Route::post('/cart','ShopController@checkout')->name('user.checkout');
Route::get('/checkout','ShopController@view_checkout')->name('user.view_checkout');
Route::post('/checkout','ShopController@bayar')->name('user.bayar');


Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminAuth\LoginController@doLogin')->name('admin.login.submit');
    Route::get('/logout','AdminAuth\LoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/read_notification/{read_notification}', 'AdminController@read_notification')->name('admin.notification');

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

    Route::resource('/product','Admin\AdminProductController', [
        'names' => [
            'index' => 'admin.product'
        ]
    ]);
    Route::delete('product/{product}/edit', 'Admin\AdminProductController@imageDelete')->name('product.imageDelete');
    Route::resource('/product-detail/categories','Admin\AdminCategoriesController', [
        'names' => [
            'index' => 'admin.categories'
        ]
    ]);

    Route::resource('/response','Admin\AdminResponseController', [
        'names' => [
            'index' => 'admin.response'
        ]
    ]);
});
