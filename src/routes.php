<?php

if ( config('admin.impersonating') ) {
    Route::group([
        'prefix' => config('admin.url'),
        'namespace' => 'Origami\Admin\Http\Controllers',
        'middleware' => 'web'
    ], function () {
        Route::post('impersonate/take', 'Impersonate@take');
        Route::get('impersonate/leave', 'Impersonate@leave');
    });
}
