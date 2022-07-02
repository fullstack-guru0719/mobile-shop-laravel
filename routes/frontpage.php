<?php

use Illuminate\Support\Facades\Route;

Route::get('/{uri}', [App\Http\Controllers\FrontPageController::class, 'handleRequest']);
Route::get('/builder/pagecontent/{id}', ['as' => 'builder.pagecontent', 'uses' => 'App\Http\Controllers\FrontPageController@processRequest']);

Route::get('/api/web/getproductlist', ['as' => 'api.web.getproductlist', 'uses' => 'App\Http\Controllers\FrontPageController@getProductList']);

Route::post('/api/web/cart', ['as' => 'api.web.cart', 'uses' => 'App\Http\Controllers\FrontPageController@getCartList']);
Route::get('/cart/checkout', ['as' => 'cart.checkout', 'uses' => 'App\Http\Controllers\CartController@cartCheckout']);
Route::get('/', [\App\Http\Controllers\FrontPageController::class, 'landingPage']);


Route::group(['prefix' => 'products'], function() {
  Route::get('checkout', [App\Http\Controllers\CartController::class, 'checkout']);
  Route::post('checkout', [\App\Http\Controllers\CartController::class, 'storecheckout']);
  Route::resource('cart', App\Http\Controllers\CartController::class);
  Route::get('search', [App\Http\Controllers\DeviceController::class, 'checkoutsearch']);
});

Route::get('/products', [App\Http\Controllers\FrontPageController::class, 'products']);
Route::get('/products/sell', [App\Http\Controllers\FrontPageController::class, 'productsell']);
Route::get('/products/sell/{id}', [App\Http\Controllers\FrontPageController::class, 'productselldetails']);
Route::get('/products/{model}', [App\Http\Controllers\FrontPageController::class, 'productdetails']);
Route::post('/products/sell/payment-method', [App\Http\Controllers\FrontPageController::class, 'paymentmethod']);
Route::post('/products', [App\Http\Controllers\FrontPageController::class, 'productsearch']);

Route::get('products/category/{brand}', [App\Http\Controllers\DeviceController::class, 'checkout']);
Route::get('products/storages/{product_id}',[App\Http\Controllers\DeviceController::class,'storages_api'])->withoutMiddleware(['web']);
Route::get('products/{brand}/{model}', [App\Http\Controllers\DeviceController::class, 'brandModel']);
Route::post('products/model', [App\Http\Controllers\DeviceController::class, 'model']);
Route::post('products/model/filter', [App\Http\Controllers\DeviceController::class, 'filterByStorageCondition']);
Route::post('products/network', [App\Http\Controllers\DeviceController::class, 'network']);
Route::get('/api/search',[App\Http\Controllers\DeviceController::class,"search"])->name('device.search');
Route::resource('device', App\Http\Controllers\DeviceController::class);
Route::post('device/authStore', [App\Http\Controllers\DeviceController::class, 'store']);
Route::get('product/storegettings', [App\Http\Controllers\DeviceController::class, 'storeget']);
Route::get('order/{hashedId}/shippinglabel', [App\Http\Controllers\DeviceController::class, 'shippingLabelPDF']);

Route::get('paypal/success', [App\Http\Controllers\PaypalController::class, 'success'])->name('paypal.success');
Route::get('paypal/cancel', [App\Http\Controllers\PaypalController::class, 'cancel'])->name('paypal.cancel');

Route::any('page/{uri}', [
  'uses' => 'App\Http\Controllers\WebsiteController@uri',
  'as' => 'page',
])->where('uri', '.*');