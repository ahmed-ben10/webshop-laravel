<?php

use Illuminate\Support\Facades\Route;

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

//VisitorController
Route::get('/', 'VisitorController@index')->name('home');
    //change password
    Route::get('/password/update', 'VisitorController@changePasswordRequest')->name('changePasswordRequest')->middleware('auth');
    Route::put('/password/update', 'VisitorController@changePassword')->name('changePassword')->middleware('auth');

    // edit profile
    Route::get('/profile/update', 'VisitorController@editProfileRequest')->name('editProfileRequest')->middleware('auth');
    Route::put('/profile/update', 'VisitorController@editProfile')->name('editProfile')->middleware('auth');

//OrderController
Route::get('/order/next', 'OrderController@orderNextStep')->name('orderNextStep');

Route::post('/order/next/customer', 'OrderController@saveCustomer')->name('saveCustomer');

Route::get('/order/pay', 'OrderController@orderPay')->name('orderPay');

Route::get('/order/order', 'OrderController@makeOrder')->name('makeOrder');

Route::get('/order/thankYou', 'OrderController@thankYou')->name('thankYou');

Route::post('/order/pay/save', 'OrderController@savePaymethod')->name('savePaymethod');

//CategoriesController
Route::resource('categories', 'CategoriesController');

//CartController
Route::get('/cart/product{id}/{quantity}', 'CartController@orderCount')->name('orderCount');
Route::resource('cart', 'CartController');

//AdminController
Route::get('/admin', 'AdminController@dashboard')->name('dashboard');

Route::get('/admin/orders', 'AdminController@orders')->name('orders');
Route::get('/admin/orders/{id}', 'AdminController@ordersShow')->name('ordersShow');
Route::get('/admin/orders/{id}/status/{status}', 'AdminController@ordersStatus')->name('ordersStatus');
Route::get('/admin/orders/delete/{order}', 'AdminController@ordersDelete')->name('ordersDelete');
Route::get('/admin/orders/update/{id}', 'AdminController@ordersUpdate')->name('ordersUpdate');
Route::put('/admin/orders/update/{id}/put', 'AdminController@orderUpdateForm')->name('orderUpdateForm');
Route::get('/admin/orders/{order}/map', 'AdminController@map')->name('orderMap');

Route::get('/admin/producten', 'AdminController@products')->name('products');
// RESET SESSION
Route::get('/forget', 'OrderController@forgertSession')->name('forget');


Auth::routes();
