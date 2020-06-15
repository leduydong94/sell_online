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

// Route::get('/', function () {
//     return view('welcome');
// });
// Order Page

    Route::get('/', 'PageController@index')->name('index');

	Route::get('product-type/{typeId}', 'PageController@product_type')->name('product-type');

	Route::get('product-detail/{productId}', 'PageController@product_detail')->name('product-detail');

	Route::get('contact', 'PageController@contact')->name('contact');

	Route::get('about', 'PageController@about')->name('about');

	Route::get('x', 'PageController@x')->name('x');

	Route::get('add-to-cart/{productId}', 'PageController@add_to_cart')->name('add-to-cart');

	Route::get('delete-cart/{productId}', 'PageController@delete_cart')->name('delete-cart');

	Route::get('check-out', 'PageController@checkout')->name('check-out');

	Route::post('check-out', 'PageController@postCheckOut')->name('post-check-out');

// Auth Page

Route::middleware('checklogin')->group(function () {

    Route::get('register', 'AuthController@register')->name('get-register');

	Route::post('register', 'AuthController@postRegister')->name('register');

	Route::get('login', 'AuthController@login')->name('get-login');

	Route::post('login', 'AuthController@postLogin')->name('login');

});

// User Page

	Route::get('change-password/{id}', 'UserController@changePassword')->name('get-change-password');

	Route::put('change-password/{id}', 'UserController@postChangePassword')->name('change-password');

Route::middleware('checkcustomer')->group(function () {

    Route::get('users', 'UserController@index')->name('users');

	Route::get('users/create', 'UserController@create')->name('create-user');

	Route::post('users/create', 'UserController@store')->name('store-user');

	Route::get('users/edit/{id}', 'UserController@edit')->name('edit-user');

	Route::put('users/edit/{id}', 'UserController@update')->name('update-user');

	Route::delete('users/delete/{id}', 'UserController@destroy')->name('delete-user');

	Route::get('logout', 'UserController@logout')->name('logout');
});



// Role Page

Route::middleware('checkcustomer')->group(function () {

    Route::get('roles', 'RoleController@role')->name('roles');

	Route::get('roles/create', 'RoleController@create')->name('create-role');

	Route::post('roles/create', 'RoleController@store')->name('store-role');

	Route::get('roles/edit/{id}', 'RoleController@edit')->name('edit-role');

	Route::put('roles/edit/{id}', 'RoleController@update')->name('update-role');

	Route::delete('roles/delete/{id}', 'RoleController@destroy')->name('delete-role');
});



// Product Page

Route::middleware('checkcustomer')->group(function () {

    Route::get('products', 'ProductController@index')->name('products');

	Route::get('products/create', 'ProductController@create')->name('create-product');

	Route::get('products/{id}', 'ProductController@show')->name('detail-product');

	Route::post('products/create', 'ProductController@store')->name('store-product');

	Route::get('products/edit/{id}', 'ProductController@edit')->name('edit-product');

	Route::put('products/edit/{id}', 'ProductController@update')->name('update-product');

	Route::delete('products/delete/{id}', 'ProductController@destroy')->name('delete-product');
});



// Product Type Page

Route::middleware('checkcustomer')->group(function () {

    Route::get('product-types', 'ProductTypeController@index')->name('product-types');

	Route::get('types/create', 'ProductTypeController@create')->name('create-type');

	Route::post('types/create', 'ProductTypeController@store')->name('store-type');

	Route::get('types/edit/{id}', 'ProductTypeController@edit')->name('edit-type');

	Route::put('types/edit/{id}', 'ProductTypeController@update')->name('update-type');

	Route::delete('types/delete/{id}', 'ProductTypeController@destroy')->name('delete-type');

});


// Bill Page

Route::middleware('checkcustomer')->group(function () {

    Route::get('bills', 'BillController@index')->name('bills');

	Route::get('bills/edit/{id}', 'BillController@editBill')->name('edit-bill');

	Route::put('bills/edit/{id}', 'BillController@updateBill')->name('update-bill');

	Route::delete('bills/delete/{id}', 'BillController@destroyBill')->name('delete-bill');

	Route::get('bill-details', 'BillController@show')->name('bill-details');

	Route::get('bill-details/edit/{id}', 'BillController@editDetail')->name('edit-detail');

	Route::put('bill-details/edit/{id}', 'BillController@updateDetail')->name('update-detail');

	Route::delete('bill-details/delete/{id}', 'BillController@destroyDetail')->name('delete-detail');
});



// Customer Page

Route::middleware('checkcustomer')->group(function () {

    Route::get('customers', 'CustomerController@index')->name('customers');

	Route::delete('customers/delete/{id}', 'CustomerController@destroy')->name('delete-customer');
});

// Slide Page

Route::middleware('checkcustomer')->group(function () {

    Route::get('slides', 'SlideController@index')->name('slides');

	Route::get('slides/create', 'SlideController@create')->name('create-slide');

	Route::post('slides/create', 'SlideController@store')->name('store-slide');

	Route::get('slides/edit/{id}', 'SlideController@edit')->name('edit-slide');

	Route::put('slides/edit/{id}', 'SlideController@update')->name('update-slide');

	Route::delete('slides/delete/{id}', 'SlideController@destroy')->name('delete-slide');
});




