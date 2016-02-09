<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Route::get('purchases',['as'=>'purchases','uses'=>'PurchasesController@index']);
Route::get('trainCar',['as'=>'trainCar','uses'=>'PurchasesController@trainCar']);
Route::get('trainCarPriceList/{id}',['as'=>'trainCarPriceList','uses'=>'PurchasesController@getPriceList']);
Route::get('trainCarPriceListInCategory/{categoryName}/{depoId}',['as'=>'trainCarPriceListInCategory','uses'=>'PurchasesController@getPriceListInCurrentCategory']);
Route::get('showTrainCarProduct/{id}/{depoId}',['as'=>'showTrainCarProduct','uses'=>'PurchasesController@showTrainCarProduct']);
Route::get('trainCarService',['as'=>'trainCarService','uses'=>'PurchasesController@trainCarService']);

Route::get('admin',['as'=>'admin','uses'=>'AdminController@index']);

Route::resource('regions', 'RegionController', ['except' => ['show']]);

Route::resource('statuses', 'StatusController', ['except' => ['show']]);

Route::resource('trainRoads', 'TrainRoadsController');
Route::resource('stations', 'StationController');

Route::resource('years', 'YearController', ['except' => ['show']]);
Route::resource('conditions', 'ConditionController', ['except' => ['show']]);
Route::resource('factories', 'FactoryController', ['except' => ['show']]);

Route::resource('categories', 'CategoryController', ['except' => ['show']]);
Route::resource('products', 'ProductController');
Route::resource('services', 'ServiceController');

Route::post('addToProductCart/{user_id}/{product_id}/{price_id}', ['as'=>'addToProductCart', 'uses'=>'ProductCartController@store']);
Route::get('productCart', ['as'=>'productCart', 'uses'=>'ProductCartController@index']);
Route::delete('productCartDestroy/{id}', ['as'=>'productCartDestroy', 'uses'=>'ProductCartController@destroy']);
Route::put('productCartUpdate/{id}/{value}', ['as'=>'productCartUpdate', 'uses'=>'ProductCartController@update']);

Route::get('fatal_error',['as'=>'fatalError', 'uses'=>'FatalErrorController@index']);

Route::get('cabinet', ['as'=>'cabinet', 'uses'=>'CabinetController@index']);

Route::get('firm', ['as'=>'firm.edit', 'uses'=>'FirmController@edit']);
Route::put('firmUpdate', ['as'=>'firm.update', 'uses'=>'FirmController@update']);

Route::post('confirmOrder/{user_id}', ['as'=>'confirmOrder', 'uses'=>'OrderController@confirm']);
Route::get('confirmOrder/{user_id}', ['as'=>'confirmOrder', 'uses'=>'OrderController@confirm']);
//Route::get('storeOrder/{user_id}', ['as'=>'storeOrder', 'uses'=>'OrderController@store']);
Route::post('store_order', ['as'=>'storeOrder', 'uses'=>'OrderController@store']);
Route::get('showMyOrders', ['as'=>'showMyOrders', 'uses'=>'OrderController@showOrders']);
Route::get('showSpecificOrder/{order_id}/{user_id}', ['as'=>'showSpecificOrder', 'uses'=>'OrderController@showSpecificOrder']);
Route::get('showOrdersToAdmin/{newOnly?}', ['as'=>'showOrdersToAdmin', 'uses'=>'OrderController@showOrdersToAdmin']);
Route::get('showSpecificOrderToAdmin/{order_id}', ['as'=>'showSpecificOrderToAdmin', 'uses'=>'OrderController@showSpecificOrderToAdmin']);
Route::post('changeStatus/{status_id}/{order_id}', ['as'=>'changeStatus', 'uses'=>'OrderController@changeStatus']);

Route::get('showMyDocs', ['as'=>'showMyDocs', 'uses'=>'CreateDocumentsController@showDocs']);
//Route::get('invoice/{order_id}/{depo_name}/{look}', ['as'=>'invoice', 'uses'=>'OrderController@invoice']);
Route::get('createDoc/{order_id}/{is_torg}', ['as'=>'createDoc', 'uses'=>'CreateDocumentsController@create']);
Route::post('download', ['as'=>'downloadDoc', 'uses'=>'CreateDocumentsController@download']);