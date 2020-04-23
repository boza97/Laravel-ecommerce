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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/products', 'ProductsController@index')->name('products');
Route::get('/products/{id}', 'ProductsController@show')->name('product');
Route::get('/products/category/{id}', 'ProductsController@productsByCategory')->name('productsByCategory');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart', 'CartController@store')->name('addToCart');
Route::delete('/cart/{id}', 'CartController@destroy')->name('removeFromCart');

Route::get('/orders', 'OrdersController@index')->name('orders');
Route::DELETE('/orders', 'OrdersController@destroy')->name('deleteOrder');
Route::post('/order', 'OrdersController@addQuantity')->name('addQuantity');
Route::get('/order', 'OrdersController@order')->name('order');
Route::post('/order/store', 'OrdersController@store')->name('addOrder');

Route::get('/admin/orders', 'AdminOrdersController@index')->name('adminOrders');
Route::get('/admin/orders/{id}', 'AdminOrdersController@show')->name('adminOrderShow');
Route::patch('/admin/orders/{id}', 'AdminOrdersController@update')->name('adminOrderUpdate');

Route::get('/admin/products', 'AdminProductsController@index')->name('adminProducts');
Route::get('/admin/products/{id}/{featured}', 'AdminProductsController@featured')->name('adminProductFeatured');
Route::get('/admin/products/create', 'AdminProductsController@create')->name('adminAddProduct');
Route::post('/admin/products', 'AdminProductsController@store')->name('adminStoreProduct');
Route::get('/admin/products/{id}', 'AdminProductsController@edit')->name('adminEditProduct');
Route::get('/admin/products/{id}/image/delete', 'AdminProductsController@deleteImage')->name('adminDeleteProductImage');
Route::patch('/admin/products/{id}', 'AdminProductsController@update')->name('adminUpdateProduct');

Route::get('/admin/users', 'AdminUsersController@index')->name('adminUsers');
Route::get('/admin/users/create', 'AdminUsersController@create')->name('adminAddUser');
Route::post('/admin/users', 'AdminUsersController@store')->name('adminStoreUser');
Route::delete('/admin/users/{id}', 'AdminUsersController@destroy')->name('adminDeleteUser');

Route::get('/news', 'NewsController@index')->name('news');