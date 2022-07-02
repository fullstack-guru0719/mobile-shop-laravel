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

Route::get('try', [App\Http\Controllers\Admin\DashboardController::class, 'trying_view']);
Auth::routes();
Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['auth:web']], function () {
    Route::group(['prefix' => 'settings'], function () {
        Route::get('pages/section/{id}', [\App\Http\Controllers\Admin\PageController::class, 'pagesection']);
        Route::get('pages/content/{id}', [\App\Http\Controllers\Admin\PageController::class, 'pagecontent']);
        Route::get('pages/image/{id}', [\App\Http\Controllers\Admin\PageController::class, 'pageimage']);
        Route::get('pages/sectionimage/{id}', [\App\Http\Controllers\Admin\PageController::class, 'pagesectionimage']);
        Route::post('pages/manage', [\App\Http\Controllers\Admin\PageController::class, 'manage']);
        Route::post('pages/storestatic', [\App\Http\Controllers\Admin\PageController::class, 'storestatic']);
        Route::delete('pages/section/{id}', [\App\Http\Controllers\Admin\PageController::class, 'removesection']);
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);

        Route::resource('config', \App\Http\Controllers\Admin\ConfigController::class);
    });


    Route::get('customers', [\App\Http\Controllers\Admin\PageViewerController::class, 'Customers']);


    // Route::prefix('orders')->name('orders.')->group(function () {
    //     Route::patch('/bulk-order-update', [\App\Http\Controllers\Admin\OrderController::class, 'bulk_update'])->name('bulk_update');
    // });
    Route::post('/bulk-order-update', ['as' => 'orders.bulk_update', 'uses' => 'App\Http\Controllers\Admin\OrderController@bulk_update']);

    Route::get('orders/{hashedId}/generatePDF', [\App\Http\Controllers\Admin\OrderController::class, 'generatePDF']);
    Route::get('orders/{hashedId}/orderItem', [\App\Http\Controllers\Admin\OrderController::class, 'getOrderItem']);
    Route::get('orders/shipping-status/{shippingId}', [\App\Http\Controllers\Admin\OrderController::class, 'get_shipping_status']);
    Route::delete('orders/{hashedId}/delete', [\App\Http\Controllers\Admin\OrderController::class, 'delete']);
    Route::delete('orders/deleteMany', [\App\Http\Controllers\Admin\OrderController::class, 'deleteMany']);
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);

    Route::group(['prefix' => 'pagebuilder'], function () {
        Route::get('/', ['as' => 'admin.pagebuilder.index', 'uses' => 'App\Http\Controllers\Admin\PageBuilderController@index']);
        Route::post('/', ['as' => 'admin.pagebuilder.post', 'uses' => 'App\Http\Controllers\Admin\PageBuilderController@store']);
        Route::get('{hashedId}', ['as' => 'admin.pagebuilder.edit', 'uses' => 'App\Http\Controllers\Admin\PageBuilderController@edit']);
        Route::put('{hashedId}', ['as' => 'admin.pagebuilder', 'uses' => 'App\Http\Controllers\Admin\PageBuilderController@update']);
        Route::get('{hashedid}/build', ['as' => 'admin.pagebuilder.build', 'uses' => 'App\Http\Controllers\Admin\PageBuilderController@build']);
        Route::put('{id}/build', ['as' => 'admin.pagebuilder.build', 'uses' => 'App\Http\Controllers\Admin\PageBuilderController@buildPage']);
        Route::get('{hashedid}/build/getcontent', ['as' => 'admin.pagebuilder.build.getcontent', 'uses' => 'App\Http\Controllers\Admin\PageBuilderController@getContent']);

        Route::get('{hashedId}/tags', [\App\Http\Controllers\Admin\PageViewerController::class, 'MetaTags']);
    });


    Route::group(['prefix' => 'products', 'name' => 'products.'], function () {
        Route::get('list-all/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'listfile']);
        Route::post('getproduct', [\App\Http\Controllers\Api\DatatableController::class, 'GetProduct']);
        Route::post('postproduct', [\App\Http\Controllers\Admin\ProductController::class, 'postproduct']);
        Route::post('storephoto', [\App\Http\Controllers\Admin\ProductController::class, 'storephoto']);
        Route::post('deletephoto', [\App\Http\Controllers\Admin\ProductController::class, 'deletephoto']);
        Route::post('checkduplicate', [\App\Http\Controllers\Admin\ProductController::class, 'checkduplicate'])->withoutMiddleware(['web', 'auth:web']);
        Route::post('checkduplicatedevice', [\App\Http\Controllers\Admin\ProductController::class, 'checkduplicatedevice']);
        Route::post('storeduplicate', [\App\Http\Controllers\Admin\ProductController::class, 'storeduplicate']);
        Route::put('{hashedId}', [\App\Http\Controllers\Admin\ProductController::class, 'update']);
        Route::get('storage/{hashedId}/find', [\App\Http\Controllers\Admin\ProductController::class, 'findProductStorage']);
        Route::post('edit/add-storage-price/{phone_id}', [\App\Http\Controllers\Admin\ProductController::class, "add_storage_price"]);
        Route::patch('edit/product-storage/{product_storage_id}', [\App\Http\Controllers\Admin\ProductController::class, "edit_storage_price"])->name('edit.product_storage');
        Route::delete('delete/add-storage-price/{phone_id}', [\App\Http\Controllers\Admin\ProductController::class, "delete_storage_price"]);
        Route::post('edit/add-device-price/{phone_id}', [\App\Http\Controllers\Admin\ProductController::class, "add_device_price"]);
        Route::patch('edit/edit-selling-device/{phone_id}', [\App\Http\Controllers\Admin\ProductController::class, "edit_selling_device"]);
        Route::get('map/condition', [\App\Http\Controllers\Admin\PageViewerController::class, 'ProductMaps']);
        Route::delete('edit/delete-device-price/{phone_id}', [\App\Http\Controllers\Admin\ProductController::class, "delete_device_price"]);
        Route::delete('bulk-delete', [\App\Http\Controllers\Admin\ProductController::class, 'bulk_delete'])->name('bulk_delete');
    });

    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);


    // Route::get('/admin/sorting', [App\Http\Controllers\Admin\SortingController::class, 'index'])->name('index');
    // Route::post('/admin/sorting', [App\Http\Controllers\Admin\SortingController::class, 'update'])->name('update');
    Route::group(
        ['prefix' => 'sorting', 'name' => 'sorting.'],
        function () {
            Route::get('/', [\App\Http\Controllers\Admin\SortingController::class, 'index'])->name('index');
            Route::post('/', [\App\Http\Controllers\Admin\SortingController::class, 'update'])->name('update');
        }
    );


    Route::group(['prefix' => 'templates'], function () {
        Route::group(['prefix' => 'email'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\PageViewerController::class, 'EmailTemplates']);
            // Route::post('/', [\App\Http\Controllers\Api\ApiController::class, 'GetEmailTemplates']);
        });
        Route::group(['prefix' => 'sms'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\PageViewerController::class, 'SmsTemplates']);
            // Route::post('/', [\App\Http\Controllers\Api\ApiController::class, 'GetEmailTemplates']);
        });
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('status', [\App\Http\Controllers\Admin\PageViewerController::class, 'Status']);
        Route::get('categories', [\App\Http\Controllers\Admin\PageViewerController::class, 'Categories']);
        Route::get('menus', [\App\Http\Controllers\Admin\PageViewerController::class, 'Menus']);

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\PageViewerController::class, 'Users']);
            Route::get('/create', [\App\Http\Controllers\Admin\PageViewerController::class, 'CreateUser']);
            Route::post('/store', [\App\Http\Controllers\Api\ApiController::class, 'StoreUser']);
            Route::get('/{hashedid}/edit', [\App\Http\Controllers\Admin\PageViewerController::class, 'EditUser']);
            Route::put('/{hashedid}', [\App\Http\Controllers\Api\ApiController::class, 'UpdateUser']);
            Route::delete('/{hashedid}', [\App\Http\Controllers\Api\ApiController::class, 'DestroyUser']);
        });

        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\PageViewerController::class, 'Brands']);
            Route::post('/', [\App\Http\Controllers\Api\ApiController::class, 'StoreBrands']);
        });

        // Routes for Settings Phone Carriers
        Route::name('admin.settings.phone_carriers.')->group(function () {
            Route::get('phone-carriers', [App\Http\Controllers\Admin\NetworkController::class, 'index'])->name('index');
            Route::prefix('api/phone-carriers')->group(function () {
                Route::post('create', [App\Http\Controllers\Admin\NetworkController::class, 'store'])->name('store');
                Route::patch('edit/{id}', [App\Http\Controllers\Admin\NetworkController::class, 'update'])->name('update');
                Route::delete('delete/{id}', [App\Http\Controllers\Admin\NetworkController::class, 'delete'])->name('delete');
            });
        });

        // Routes for Settings Phone Storages
        Route::name('admin.settings.phone_storages.')->group(function () {
            Route::get('phone-storages', [App\Http\Controllers\Admin\SettingsStorageController::class, 'index'])->name('index');
            Route::prefix('api/phone-storages')->group(function () {
                Route::post('create', [App\Http\Controllers\Admin\SettingsStorageController::class, 'store'])->name('store');
                Route::patch('edit/{id}', [App\Http\Controllers\Admin\SettingsStorageController::class, 'update'])->name('update');
                Route::delete('delete/{id}', [App\Http\Controllers\Admin\SettingsStorageController::class, 'destroy'])->name('delete');
            });
        });
    });

    Route::get('pages/overview', function () {
        return 'qwe';
    });

    Route::get('204', function () {
        return view('204');
    });
});

// Route::group(['prefix' => 'email'], function () {
//     Route::get('/', [\App\Http\Controllers\Admin\PageViewerController::class, 'EmailTemplates']);
//     // Route::post('/', [\App\Http\Controllers\Api\ApiController::class, 'GetEmailTemplates']);
// });




Route::group(['prefix' => 'api'], function () {
    Route::group(['middleware' => ['auth:web']], function () {
        Route::get('settings/status/{hashedId}', ['as' => 'api.settings.status', 'uses' => 'App\Http\Controllers\Api\ApiController@GetStatusDetails']);
        Route::get('settings/status/filter/{module}', ['as' => 'api.settings.status.filter', 'uses' => 'App\Http\Controllers\Api\ApiController@GetStatusByModule']);
        Route::post('settings/statuses', [App\Http\Controllers\Api\DatatableController::class, 'GetStatuses']);
        Route::patch('settings/status', ['as' => 'api.settings.status', 'uses' => 'App\Http\Controllers\Api\ApiController@PatchStatus']);
        Route::delete('settings/status/{hashedId}', ['as' => 'api.settings.status', 'uses' => 'App\Http\Controllers\Api\ApiController@DeleteStatus']);

        Route::group(['prefix' => 'orders'], function () {
            Route::get('{hashedId}', [\App\Http\Controllers\Api\ApiController::class, 'GetOrder']);
            Route::post('getorders', [\App\Http\Controllers\Api\DatatableController::class, 'getOrders']);
            Route::get('{hashedId}/paymentsuccess', [\App\Http\Controllers\Api\ApiController::class, 'OrderPaymentSuccess']);
            Route::delete('{hashedId}/orderitem', [\App\Http\Controllers\Api\ApiController::class, 'DeleteOrderItem']);
            Route::put('{hashedId}/status', [\App\Http\Controllers\Api\ApiController::class, 'UpdateOrderStatus']);
            Route::put('{hashedId}/reduction', [\App\Http\Controllers\Api\ApiController::class, 'UpdateOrderReduction']);
            Route::post('notes', ['as' => 'api.orders.notes', 'uses' => 'App\Http\Controllers\Api\ApiController@StoreOrderNotes']);
            Route::get('{hashedId}/notes', ['as' => 'api.orders.notes', 'uses' => 'App\Http\Controllers\Api\ApiController@GetOrderNotes']);
            Route::put('{hashedId}/notes', ['as' => 'api.orders.notes', 'uses' => 'App\Http\Controllers\Api\ApiController@UpdateOrderNote']);
            Route::delete('{hashedId}/notes', ['as' => 'api.orders.notes', 'uses' => 'App\Http\Controllers\Api\ApiController@DeleteOrderNote']);
        });
        Route::get('products/{id}', ['as' => 'api.products', 'uses' => 'App\Http\Controllers\Api\ApiController@GetProduct']);
        Route::patch('products/{hashedid}', ['as' => 'api.products', 'uses' => 'App\Http\Controllers\Api\ApiController@PatchProduct']);

        Route::get('modules', ['as' => 'api.modules', 'uses' => 'App\Http\Controllers\Api\ApiController@GetModules']);
        Route::get('notificationmodules', ['as' => 'api.modules', 'uses' => 'App\Http\Controllers\Api\ApiController@GetNotificationModules']);

        Route::get('enableoptions', ['as' => 'api.enableoptions', 'uses' => 'App\Http\Controllers\Api\ApiController@GetEnableOptions']);

        Route::get('pagebuilder/{hashedPageId}/tags/{hashedTagId}', [\App\Http\Controllers\Api\ApiController::class, 'GetMetaTagDetails']);
        Route::post('pagebuilder/{hashedId}/tags', [\App\Http\Controllers\Api\DatatableController::class, 'GetMetaTags']);
        Route::patch('pagebuilder/{hashedId}/tags', [\App\Http\Controllers\Api\ApiController::class, 'PatchMetaTags']);
        Route::delete('pagebuilder/{hashedPageId}/tags/{hashedTagId}', [\App\Http\Controllers\Api\ApiController::class, 'DeleteMetaTag']);

        Route::post('settings/users', [\App\Http\Controllers\Api\DatatableController::class, 'GetUsers']);

        Route::group(['prefix' => 'templates'], function () {
            Route::group(['prefix' => 'email'], function () {
                Route::post('/', [App\Http\Controllers\Api\DatatableController::class, 'GetEmailTemplates']);
                Route::patch('/', [App\Http\Controllers\Api\ApiController::class, 'PatchEmailTemplate']);
                Route::get('/{hashedId}', [App\Http\Controllers\Api\ApiController::class, 'GetEmailTemplate']);
                Route::delete('{hashedId}', [\App\Http\Controllers\Api\ApiController::class, 'DeleteEmailTemplate']);
            });
            Route::group(['prefix' => 'sms'], function () {
                Route::get('/', [App\Http\Controllers\Api\ApiController::class, 'GetSmsTemplatesList']);
                Route::post('/', [App\Http\Controllers\Api\DatatableController::class, 'GetSmsTemplates']);
                Route::patch('/', [App\Http\Controllers\Api\ApiController::class, 'PatchSmsTemplate']);
                Route::get('/{hashedId}', [App\Http\Controllers\Api\ApiController::class, 'GetSmsTemplate']);
                Route::delete('{hashedId}', [\App\Http\Controllers\Api\ApiController::class, 'DeleteSmsTemplate']);
                Route::get('/credits/remaining', [\App\Http\Controllers\Api\ApiController::class, 'GetSMSCredit']);
            });
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::group(['prefix' => 'brands'], function () {
                Route::post('getbrand', [\App\Http\Controllers\Api\DatatableController::class, 'GetBrands']);

                Route::post('/', [\App\Http\Controllers\Api\ApiController::class, 'StoreBrands']);
                Route::get('{hashedId}/edit', [\App\Http\Controllers\Api\ApiController::class, 'GetBrandDetails']);
                Route::delete('{hashedId}', [\App\Http\Controllers\Api\ApiController::class, 'DeleteBrand']);
            });
        });

        Route::post('settings/categories', [App\Http\Controllers\Api\DatatableController::class, 'GetCategories']);
        Route::patch('settings/categories', ['as' => 'api.settings.categories', 'uses' => 'App\Http\Controllers\Api\ApiController@PatchCategories']);
        Route::get('settings/categories/{hashedId}', ['as' => 'api.settings.categories', 'uses' => 'App\Http\Controllers\Api\ApiController@GetCategoryDetails']);
        Route::delete('settings/categories/{hashedId}', ['as' => 'api.settings.categories', 'uses' => 'App\Http\Controllers\Api\ApiController@DeleteCategory']);

        Route::get('pagebuilders', ['as' => 'api.pagebuilders', 'uses' => 'App\Http\Controllers\Api\ApiController@GetPageBuilderList']);
        Route::get('metatagnames', ['as' => 'api.metatagnames', 'uses' => 'App\Http\Controllers\Api\ApiController@GetMetaTagNameList']);



        Route::post('admin/customers', [App\Http\Controllers\Api\DatatableController::class, 'GetCustomers']);
        Route::delete('admin/customers/delete', [App\Http\Controllers\Api\ApiController::class, 'DeleteCustomers']);
        Route::patch('admin/customers/changepassword', [\App\Http\Controllers\Customer\ApiController::class, 'ChangePassword']);

        Route::get('admin/payment', [App\Http\Controllers\Admin\PaymentPaypalController::class, 'Payment']);
        Route::get('admin/payment/status', [App\Http\Controllers\Admin\PaymentPaypalController::class, 'GetPaymentStatus']);
        // Route::get('payment', 'PayPalController@payment')->name('payment');
        Route::get('admin/payment/cancel', [App\Http\Controllers\PaypalController::class], 'cancel')->name('api.admin.payment.cancel');
        Route::get('admin/payment/success', [App\Http\Controllers\PaypalController::class], 'success')->name('api.admin.payment.success');
    });
});

require __DIR__ . '/cronjobs.php';
require __DIR__ . '/customer.php';
require __DIR__ . '/demo.php';
require __DIR__ . '/frontpage.php';
require __DIR__ . '/webhooks.php';
