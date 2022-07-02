<?php

Route::group(['prefix' => 'cronjobs'], function () {
    Route::get('notifyday7', ['as' => 'cron.notifyday7', 'uses' => 'App\Http\Controllers\Api\ApiController@NotifyDay7']);
    Route::get('notifyday29', ['as' => 'cron.notifyday29', 'uses' => 'App\Http\Controllers\Api\ApiController@NotifyDay29']);
    Route::get('notifycustomerorder', ['as' => 'cron.notifycustomerorder', 'uses' => 'App\Http\Controllers\Api\ApiController@NotifyCustomerOrder']);
});