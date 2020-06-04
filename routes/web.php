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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function (){
    Route::get('/home', 'HomeController@index')->name('home');
});

// Administrator sections
// Categories
Route::group(['middleware' => ['auth', 'can:administrator']], function (){
    Route::prefix('kategori')->group( function() {
        Route::get('', 'CategoryController@index');
        Route::post('store', 'CategoryController@store');
        Route::get('edit/{id}', 'CategoryController@edit');
        Route::patch('update/{id}', 'CategoryController@update');
        Route::delete('destroy/{id}', 'CategoryController@destroy');
    });
});
// Products
Route::group(['middleware' => ['auth', 'can:administrator']], function (){
    Route::prefix('produk')->group( function() {
        Route::get('', 'ProductController@index');
        Route::post('store', 'ProductController@store');
        Route::get('edit/{id}', 'ProductController@edit');
        Route::patch('update/{id}', 'ProductController@update');
        Route::delete('destroy/{id}', 'ProductController@destroy');
    });
});
// Transactions
Route::group(['middleware' => ['auth', 'can:administrator']], function (){
    Route::prefix('transaksi')->group( function() {
        Route::get('', 'TransactionController@index');
        Route::get('detail/{ticket}', 'TransactionController@detail');
    });
});
// Customers
Route::group(['middleware' => ['auth', 'can:administrator']], function (){
    Route::get('customer', 'CustomerController@index');
});

// ========================================================================================
// Customers sections

// Catalogs
Route::group(['middleware' => ['auth', 'can:customer']], function (){
    Route::get('katalog', 'CatalogController@index');
    Route::post('customer/create', 'CustomerController@store');
});
// Carts & Transactions
Route::group(['middleware' => ['auth', 'can:customer']], function (){
    Route::prefix('customer')->group( function() {
        Route::get('cart', 'CartController@myCart');
        Route::post('cart/create/{idProduct}', 'CartController@create');
        Route::delete('cart/delete/{id}', 'CartController@destroy');
        Route::patch('cart/checkout/{ticket}', 'CartController@checkout');
        Route::get('mytransaksi', 'CustomerTransactionController@mytransaction');
        Route::get('mytransaksi/detail/{ticket}', 'CustomerTransactionController@transactionDetail');
    });
});


