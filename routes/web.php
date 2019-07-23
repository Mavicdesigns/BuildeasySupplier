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

Route::get('/inbox', function () {
    return view('chat/index');
})->name('chat')->middleware('auth');

Auth::routes();




Route::get('/MyOrders/newOrders', 'OrdersController@allNewOrders')->name('allNewOrders')->middleware('auth');

Route::get('/MyOrders',function(){
    return view('Orders/orders');
})->name('ViewMyProducts')->middleware('auth');

Route::get('/MyOrders/unConfirmedOrders', 'OrdersController@allConfirmationOrders')->name('allConfirmationOrders')->middleware('auth');
Route::get('/MyOrders/unDeliveredOrders', 'OrdersController@allAwaitingOrder')->name('allAwaitingOrder')->middleware('auth');
Route::get('/MyOrders/CompletedOrders', 'OrdersController@allCompletedOrder')->name('allCompletedOrder5')->middleware('auth');
Route::get('/clearNotificationSingle', 'HomeController@clearNotification')->name('clearNotificationSingle')->middleware('auth');


Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');
Route::get('/MyOrders/{id}', function($id){
    return view('Orders/single')->with('order_id',$id);
})->name('Orders')->middleware('auth');


Route::get('/profile/{name}','HomeController@profile')->name('Orders')->middleware('auth');


Route::get('/Orders/confirm/{id}', 'OrdersController@Processedsingle')->name('Processedsingle')->middleware('auth');
Route::get('/Orders/verify/{id}', 'OrdersController@verifyToken')->name('verifyToken')->middleware('auth');
Route::get('/Orders/processOrders/{id}', 'OrdersController@processOrder')->name('processOrder')->middleware('auth');

Route::get('/Products/delete/{id}', 'ProductsController@deleteProduct')->middleware('auth');
Route::get('/Products/create','ProductsController@index')->name('productCreate')->middleware('auth');
Route::get('/Products/category/create','ProductsController@createNewCategory')->middleware('auth');
Route::get('/Products/category/','ProductsController@getCategory')->middleware('auth');
Route::get('/Products/category/create/{name}','ProductsController@createCategory')->middleware('auth');


Route::get('/MyProducts',function(){
    return view('Products/view');
})->name('ViewMyProducts')->middleware('auth');

Route::get('/getAllProduct','ProductsController@allProduct')->middleware('auth');


Route::get('/MyProducts/{id}',function($id){
    return view('Products/updateProduct')
        ->with('product_id',$id);
})->name('ViewMyProductsSingle')->middleware('auth');
Route::get('/Products/getCurrentProduct/{id}','ProductsController@getCurrentProduct');


Route::get('/CreateSupplier','SupplierController@getIndex')->name('getSupplier')->middleware('auth');
Route::get('/CreateSupplierform','SupplierController@CreateSupplier')->name('supplierForm')->middleware('auth');


Route::post('Products/create/submitProducts','ProductsController@createProduct')->name('submitProduct')->middleware('auth');
