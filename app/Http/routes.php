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

//Route::get('/', 'WelcomeController@index');
Route::get('/',['as'=>'main','uses'=>'WelcomeController@index']);
Route::get('about', ['as'=>'about','uses'=>'WelcomeController@about']);
Route::get('info', ['as'=>'info','uses'=>'WelcomeController@info']);
Route::get('contacts', ['as'=>'contacts','uses'=>'WelcomeController@contacts']);

//Route::get('home', 'HomeController@index');

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

Route::resource('service_statuses', 'ServiceStatusController', ['except' => ['show']]);

Route::resource('trainRoads', 'TrainRoadsController');
Route::resource('stations', 'StationController');

//Route::resource('years', 'YearController', ['except' => ['show']]);
Route::resource('conditions', 'ConditionController', ['except' => ['show']]);
//Route::resource('factories', 'FactoryController', ['except' => ['show']]);

Route::resource('categories', 'CategoryController', ['except' => ['show']]);
Route::resource('products', 'ProductController');
Route::resource('services', 'ServiceController');

Route::post('addToProductCart/{user_id}/{product_id}/{price_id}', ['as'=>'addToProductCart', 'uses'=>'ProductCartController@store']);
Route::get('productCart', ['as'=>'productCart', 'uses'=>'ProductCartController@index']);
Route::delete('productCartDestroy/{id}', ['as'=>'productCartDestroy', 'uses'=>'ProductCartController@destroy']);
Route::put('productCartUpdate/{id}/{value}', ['as'=>'productCartUpdate', 'uses'=>'ProductCartController@update']);

Route::get('fatal_error',['as'=>'fatalError', 'uses'=>'FatalErrorController@index']);

//Route::get('cabinet', ['as'=>'cabinet', 'uses'=>'CabinetController@index']);

Route::get('firm', ['as'=>'firm.edit', 'uses'=>'FirmController@edit']);
Route::put('firmUpdate', ['as'=>'firm.update', 'uses'=>'FirmController@update']);

Route::post('confirm_service_order/{service_id}', ['as'=>'confirmServiceOrder', 'uses'=>'OrderController@confirmServiceOrder']);
Route::get('confirm_service_order/{service_id}', ['as'=>'confirmServiceOrder', 'uses'=>'OrderController@confirmServiceOrder']);
Route::post('store_service_order', ['as'=>'storeServiceOrder', 'uses'=>'OrderController@storeServiceOrder']);

Route::post('confirmOrder/{user_id}', ['as'=>'confirmOrder', 'uses'=>'OrderController@confirm']);
Route::get('confirmOrder/{user_id}', ['as'=>'confirmOrder', 'uses'=>'OrderController@confirm']);
//Route::get('storeOrder/{user_id}', ['as'=>'storeOrder', 'uses'=>'OrderController@store']);
Route::post('store_order', ['as'=>'storeOrder', 'uses'=>'OrderController@store']);
Route::get('showMyOrders', ['as'=>'showMyOrders', 'uses'=>'OrderController@showOrders']);
Route::get('showSpecificOrder/{order_id}/{user_id}/{order_type}', ['as'=>'showSpecificOrder', 'uses'=>'OrderController@showSpecificOrder']);
Route::get('showOrdersToAdmin/{newOnly?}', ['as'=>'showOrdersToAdmin', 'uses'=>'OrderController@showOrdersToAdmin']);
Route::post('showFilteredOrdersToAdmin', ['as'=>'showFilteredOrdersToAdmin', 'uses'=>'OrderController@showFilteredOrdersToAdmin']);
Route::get('showSpecificOrderToAdmin/{order_id}', ['as'=>'showSpecificOrderToAdmin', 'uses'=>'OrderController@showSpecificOrderToAdmin']);
Route::post('changeStatus/{status_id}/{order_id}/{is_service?}', ['as'=>'changeStatus', 'uses'=>'OrderController@changeStatus']);

Route::get('showServiceOrdersToAdmin/{newOnly?}', ['as'=>'showServiceOrdersToAdmin', 'uses'=>'OrderController@showServiceOrdersToAdmin']);
Route::post('showServiceFilteredOrdersToAdmin', ['as'=>'showServiceFilteredOrdersToAdmin', 'uses'=>'OrderController@showServiceFilteredOrdersToAdmin']);
Route::get('showServiceSpecificOrderToAdmin/{order_id}', ['as'=>'showServiceSpecificOrderToAdmin', 'uses'=>'OrderController@showServiceSpecificOrderToAdmin']);

Route::get('showMyDocs', ['as'=>'showMyDocs', 'uses'=>'CreateDocumentsController@showDocs']);
//Route::get('invoice/{order_id}/{depo_name}/{look}', ['as'=>'invoice', 'uses'=>'OrderController@invoice']);
Route::get('createDoc/{order_id}/{is_torg}', ['as'=>'createDoc', 'uses'=>'CreateDocumentsController@create']);
Route::post('download', ['as'=>'downloadDoc', 'uses'=>'CreateDocumentsController@download']);
Route::post('uploadDoc', ['as'=>'uploadDoc', 'uses'=>'CreateDocumentsController@uploadDocument']);

Route::get('uploadOferta', ['as'=>'uploadOferta.index', 'uses'=>'CreateDocumentsController@uploadOfertaIndex']);
Route::post('uploadOferta', ['as'=>'uploadOferta', 'uses'=>'CreateDocumentsController@uploadOferta']);
Route::get('showOferta', ['as'=>'showOferta', 'uses'=>'CreateDocumentsController@showOferta']);

Route::post('admin/send_documents', ['as'=>'sendCheckedDocuments', 'uses'=>'OrderController@sendCheckedDocuments']);

Route::get('pageTexts', ['as'=>'pageTexts', 'uses'=>'AdminController@pageTexts']);

Route::resource('contact_page_text', 'ContactPageController', ['only' => ['edit', 'update']]);
Route::resource('for_provider_text', 'ProviderPageController', ['only' => ['edit', 'update']]);
Route::resource('about_page_text', 'AboutPageController', ['only' => ['edit', 'update']]);
Route::resource('main_page_text', 'MainPageController', ['only' => ['edit', 'update']]);
Route::post('upload_about_image', ['as'=>'uploadAboutImage', 'uses'=>'AboutPageController@uploadImage']);

Route::get('edit_service_agreement_template', ['as'=>'edit_service_agreement_template', 'uses'=>'CreateDocumentsController@editServiceAgreementTemplate']);
Route::post('update_service_agreement_template', ['as'=>'update_service_agreement_template', 'uses'=>'CreateDocumentsController@updateServiceAgreementTemplate']);
Route::post('check_genitive_case/{firm_id}/{order_id}', ['as'=>'checkGenitiveCase', 'uses'=>'CreateDocumentsController@checkGenitiveCase']);
Route::post('create_service_agreement_template_and_send/{firm_id}/{order_id}', ['as'=>'createServiceAgreementTemplateAndSend', 'uses'=>'CreateDocumentsController@createServiceAgreementTemplateAndSend']);

Route::get('show_service_agreement_by_clients', ['as'=>'showServiceAgreementByClients', 'uses'=>'CreateDocumentsController@showServiceAgreementByClients']);
Route::post('create_service_agreement', ['as'=>'createServiceAgreement', 'uses'=>'CreateDocumentsController@createServiceAgreement']);
Route::post('uploadServiceAgreementFromClient', ['as'=>'uploadServiceAgreementFromClient', 'uses'=>'CreateDocumentsController@uploadServiceAgreementFromClient']);
Route::get('show_service_agreement_with_client/{id}', ['as'=>'showServiceAgreementWithClient', 'uses'=>'CreateDocumentsController@showServiceAgreementWithClient']);
