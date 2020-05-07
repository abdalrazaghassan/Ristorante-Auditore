<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;

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

Route::get('/' , function (){
    // redirect to login page
});

Route::view('/index','index');

Route::post('/login','LoginController@checkUser')->name('login');

Route::prefix('/manager')->group(function () {

    Route::get('/' , 'ManagerController@dashboard');

    Route::post('/','ManagerController@deleteTable')->name('manager.deleteTable');

    Route::post('/addTable','ManagerController@addTable')->name('submit.addTable');

    Route::post('/addItem','ManagerController@addItem')->name('manager.addItem');

    Route::post('/submitSizeAndPrice','ManagerController@submitSizeAndPrice')->name('dish.submit.sizeAndPrice');

    Route::post('/deleteItem' , 'ManagerController@deleteItem')->name('manager.deleteItem');

    Route::post('/submit' , 'ManagerController@submitIngrediant')->name('manager.submit.ingrediant');

    Route::get('/addDeleteSupplier' , 'SupplierController@Dashboard');

    Route::post('/addCategory' , 'ManagerController@addCategory')->name('manager.addCategry');

    Route::post('/addSupplier','SupplierController@addSupplier')->name('addSupplier');

    Route::post('/DeleteSupplier','SupplierController@deleteSupplier')->name('deleteSupplier');

    Route::get('/check' , 'ManagerController@retriveOrdersFromWareHouseOrder');

    Route::post('/addOffers' , 'ManagerController@addOffers')->name('submit.offer');

    Route::get('/removeOffer/{id}','ManagerController@removeOffer');
});

Route::prefix('kitchen')->group(function (){

    Route::get('/' , 'KitchenController@index');

    Route::post('/addIngrediant' , 'KitchenController@addIngrediant')->name('kitchen.addIngrediant');

    Route::get('/confirmOrder/{order}' , 'KitchenController@confirmOrder')->name('kitchen.confirmOrder');

    Route::get('/removeIngrediant/{id}' , 'KitchenController@removeIngrediant');

});

Route::prefix('menu')->group(function (){

    Route::get('/' , 'MenuController@index');

    Route::post('/submit/order/' , 'MenuController@submitOrder')->name('menu.submit.order');

    Route::get('/addNotes/{id}', 'MenuController@addNotes')->name('menu.addNotes');

    Route::get('/removeOrderFromCarts/{cartOrder_id}','MenuController@removeOrderFromCart');

    Route::post('/menuConfirmOrder','MenuController@ConfirmOrderAndTransfer')->name('menu.confirm.transferCarts');

    Route::post('/menuSubmitOffer','MenuController@submitOffer')->name('menu.submit.offer');

});

Route::prefix('/supplier')->group(function (){

    Route::get('/','SupplierController@Dashboard');

    Route::post('/addSupplier','SupplierController@addSupplier')->name('addSupplier');

    Route::post('/deleteSupplier','SupplierController@deleteSupplier')->name('deleteSupplier');


});







