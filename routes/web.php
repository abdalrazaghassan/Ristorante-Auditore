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




Route::get('/manager' , 'ManagerController@dashboard');

Route::post('/manager','ManagerController@deleteTable')->name('manager.deleteTable');

Route::post('/manager/addItem','ManagerController@addItem')->name('manager.addItem');

Route::post('/manager/submitSizeAndPrice','ManagerController@submitSizeAndPrice')->name('dish.submit.sizeAndPrice');

Route::post('/manager/deleteItem' , 'ManagerController@deleteItem')->name('manager.deleteItem');

Route::post('/manager/submit' , 'ManagerController@submitIngrediant')->name('manager.submit.ingrediant');

Route::get('/manager/addDeleteSupplier' , 'SupplierController@Dashboard');

Route::post('/manager/addSupplier','SupplierController@addSupplier')->name('addSupplier');

Route::post('/manager/DeleteSupplier','SupplierController@deleteSupplier')->name('deleteSupplier');

Route::get('/kitchen/' , 'KitchenController@index');

Route::post('/kitchen/addIngrediant' , 'KitchenController@addIngrediant')->name('kitchen.addIngrediant');

Route::get('/kitchen/confirmOrder/{order}' , 'KitchenController@confirmOrder')->name('kitchen.confirmOrder');

Route::get('/manager/check' , 'ManagerController@retriveOrdersFromWareHouseOrder');

Route::get('/menu' , 'MenuController@index');

Route::post('/menu/submit/order/' , 'MenuController@submitOrder')->name('menu.submit.order');



















//Route::get('/manager-ing',function (){
//    return view('admin/manager-ing');
//});
//
//Route::get('/manager-modsup' , function (){
//   return view('admin/manager-modsup');
//});
//
//Route::get('/manager-oh' , function (){
//   return view('admin/manager-oh') ;
//});

