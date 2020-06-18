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

use Illuminate\Http\Request;

Route::get('/', function () {
      return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/settings',function(Request $req){
	// echo $req->id;
	// exit;
	return view('settings');
})->name('settings');

// CLIENTS ROUTES
Route::get('/sites','ClientController@index')->name('clients');
Route::get('/sites/create','ClientController@create')->name('createclient');
Route::post('/sites/save','ClientController@save')->name('saveclient');
Route::patch('/sites/update','ClientController@update')->name('updateclient');
Route::patch('/sites/archive/{idno}','ClientController@archive')->name('archiveclient');
Route::get('/getClientData','ClientController@getClientData');
Route::get('/getClientArchive','ClientController@archivelist');
Route::get('/sites/archive','ClientController@archiveindex')->name('archiveindex');
Route::get('/getClient/{idno}','ClientController@getClient');

Route::get('/supplier','ClientController@supplier')->name('supplier');
Route::get('/supplier/archive','ClientController@archivesupplier')->name('archivesupplier');
Route::get('/getSupplierDate','ClientController@getSupplierDate');
Route::get('/getSupplierArchive','ClientController@supplierarchivelist');
Route::get('/sites/bulkinsert',function(){
	return view('Client.bulkinsert');
})->name('bulkinsertSites');
Route::post('/sites/bulkinsert','ClientController@bulkinsert')->name('insertBulkSite');
Route::get('/supplier/bulkinsert',function(){
	return view('supplier.bulkinsert');
})->name('bulkinsertSupplier');


// UNIT ROUTES
Route::get('/units','UnitController@index');
Route::post('/addUnit','UnitController@addUnit')->name('addUnit');
Route::patch('/unit/archive/{idno}','UnitController@archive');
Route::patch('/unit/update','UnitController@update')->name('updateUnit');


// ITEM ROUTES
Route::get('/item/list','ItemController@index');
Route::get('/getItemData/{filter}','ItemController@getItemData');
Route::get('/item/list/details/{idno}','ItemController@getItemListDetails');
Route::post('/saveitem','ItemController@saveitem')->name('saveitem');
Route::patch('/item/archive/{idno}','ItemController@archive');
Route::patch('/updateItemInfo','ItemController@updateItemInfo');
Route::get('/item/archive','ItemController@getarchive');
Route::get('/getItemArchive','ItemController@getItemArchive');
Route::patch('/item/restore/{idno}','ItemController@restore');
Route::post('/item/manualaddstocks','ItemController@manualaddstocks');
Route::patch('/item/itemlistmanualadd/{idno}','ItemController@itemlistmanualadd');
Route::post('/item/updateImage','ItemController@updateImage')->name('updateItemImage');
Route::get('/item/bulkinsert',function(){
	return view("Item.bulkinsert");
})->name("bulkinsert");
Route::post('/item/bulkinsert','ItemController@bulkinsert')->name('insertBulkItem');



// INBOUND ROUTES
Route::get('/inbound/create','InboundController@createInbound')->name('createInbound');
Route::post('/createInbound','InboundController@saveInbound');
Route::get('/inbound/pending','InboundController@pendingInbound')->name('pendingInbound');
Route::get('/inbound/pending/{idno}','InboundController@pendingView');
Route::patch('/updateInboundStatus/{idno}','InboundController@updateInboundStatus');
Route::patch('/updateItemListInfo/{idno}','InboundController@updateItemListInfo');
Route::get('/getItemInfoData/{idno}','InboundController@getItemInfoData');
Route::get('/inbound/list','InboundController@approvedInbound')->name('approvedInbound');
Route::get('/inbound/detailed/reports','InboundController@detailedreports')->name('inboundReports');
Route::get('/getInboundData','InboundController@getInboundData');
Route::get('/inbound/view/{idno}','InboundController@viewInbound');
Route::get('/inbound/view/{idno}/summary','InboundController@viewInboundSummary');
Route::get('/inbound/view/{idno}/detailed','InboundController@viewInboundDetailed');
Route::patch('/inbound/update/{idno}','InboundController@update');
Route::patch('/inbound/approved/{idno}','InboundController@approved');


// OUTBOUND ROUTES
Route::get('/outbound/create','OutboundController@createOutbound')->name('createOutbound');
Route::get('/outbound/getItem/{bcode}','OutboundController@getItem');
Route::get('/manualAddItem','OutboundController@manualAddItem')->name('manualAddItem');
Route::get('/outbound/iteminfo/{id}','OutboundController@outboundItemlist');
Route::post('/outbound/save','OutboundController@saveOutbound');
Route::get('/outbound/list','OutboundController@approvedOutbound')->name('approvedOutbound');
Route::get('/getOutboundData','OutboundController@getOutboundData');
Route::get('/outbound/view/{idno}','OutboundController@viewOutbound');
Route::get('/outbound/view/{idno}/summary','OutboundController@viewOutboundSummary');
Route::get('/outbound/view/{idno}/detailed','OutboundController@viewOutboundDetailed');
Route::get('/outbound/pending/list','OutboundController@pendingOutbound')->name('pendingOutbound');
Route::get('/outbound/pending/list/{idno}','OutboundController@pendingOutboundView');
Route::patch('/outbound/update/{idno}','OutboundController@update');
Route::patch('/outbound/approved/{idno}','OutboundController@approved');



// DELIVERY ROUTES
Route::get('/dispatch/create','DispatchController@create')->name('dispatchCreate');
Route::get('/dispatch/list','DispatchController@list')->name('dispatchlist');
Route::get('/dispatch/iteminfo/{id}','DispatchController@dispatchItemlist');
Route::get('/dispatch/getItem/{bcode}','DispatchController@getItem');
Route::post('/dispatch/create','DispatchController@save');
Route::get('/getDeliveryData','DispatchController@getDeliveryData');
Route::get('/dispatch/view/{idno}','DispatchController@viewDispatch');
Route::get('/dispatch/view/{idno}/summary','DispatchController@viewDispatchSummary');
Route::get('/dispatch/view/{idno}/detailed','DispatchController@viewDispatchDetailed');
Route::get('/dispatch/pending/list','DispatchController@pending')->name('pendingDispatch');
Route::get('/dispatch/pending/list/{idno}','DispatchController@pendingDispatchView');
Route::patch('/dispatch/update/{idno}','DispatchController@update');
Route::patch('/dispatch/approved/{idno}','DispatchController@approved');



// RETURN ROUTES
Route::get('/return/create','ReturnController@create')->name('returnCreate');
Route::post('/return/create','ReturnController@save');
Route::get('/return/pending/list','ReturnController@pending')->name('returnPending');
Route::get('/return/pending/{idno}','ReturnController@pendingview');
Route::patch('/return/update/{idno}','ReturnController@update');
Route::patch('/return/approved/{idno}','ReturnController@approved');
Route::get('/return/approved/list','ReturnController@getlist')->name('returnlist');
Route::get('/getReturnData','ReturnController@getReturnData');
Route::get('/return/view/{idno}','ReturnController@view');
Route::get('/return/view/{idno}/summary','ReturnController@viewSummary');
Route::get('/return/view/{idno}/detailed','ReturnController@viewDetailed');




// USER ROUTES
Route::patch('/changepassword/{idno}','SettingController@changepassword');
Route::get('/users/list','SettingController@userlist')->name('manageusers');
Route::post('/user/add','SettingController@adduser');
Route::patch('/user/archive/{idno}','SettingController@archiveuser');
Route::patch('/user/update/{idno}','SettingController@updateuser');



// REPORTS ROUTES
Route::get('/reports','ReportController@index');
Route::post('/reports/validate','ReportController@validation');
Route::get('/reports/outbound/{datefrom}/{dateto}/{type}','ReportController@outbound');
Route::get('/reports/inbound/{datefrom}/{dateto}/{type}','ReportController@inbound');
Route::get('/reports/delivery/{datefrom}/{dateto}/{type}','ReportController@delivery');
Route::get('/reports/return/{datefrom}/{dateto}/{type}','ReportController@returnItem');

Route::get('/export/inboundPdf/{from}/{to}/{type}','ReportController@inboundPdf');
Route::get('/export/outboundPdf/{from}/{to}/{type}','ReportController@outboundPdf');
Route::get('/export/deliveryPdf/{from}/{to}/{type}','ReportController@deliveryPdf');
Route::get('/export/returnPdf/{from}/{to}/{type}','ReportController@returnPdf');



// EXPORT ROUTES
Route::get('/exportItemList','ExportController@exportItemList');
Route::get('/exportItemListDetailed','ExportController@exportItemListDetailed');
Route::get('/export/inbound/{from}/{to}/{type}','ExportController@Inbound');
Route::get('/export/outbound/{from}/{to}/{type}','ExportController@Outbound');
Route::get('/export/delivery/{from}/{to}/{type}','ExportController@Delivery');
Route::get('/export/return/{from}/{to}/{type}','ExportController@Returnitem');





Route::get('/item/information/barcode',function(){
	return view('checkiteminfo');
})->name('checkiteminfo');
Route::get('/scanbarcodeItem/{bcode}','ItemController@scanbarcodeItem');
Route::get('/company/setting','SettingController@companysetting')->name('companyinfo');
Route::post('/updateCompanySetting','SettingController@updateCompanySetting')->name('updateCompanySetting');





Route::get('/test',function(){
	return view('test');
});


Route::get('/testitem','ItemController@testitem');

Route::get('/testexport','TestController@index');
