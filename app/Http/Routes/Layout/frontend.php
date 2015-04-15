<?php


/*
 * Basic Route for Frontend View
 */
Route::get('/', function () {
    return View::make('ngApp');
});

Route::group(['prefix' => '/' ], function () {

    Route::get('{route}', function ($route) {
        return View::make('ngApp');
    });

    Route::get('{route}/{second}', function ($route, $second) {
        return View::make('ngApp');
    });

    Route::get('{route}/{second}/{third}', function ($route, $second, $third) {
        return View::make('ngApp');
    });
    Route::get('{route}/{second}/{third}/{forth}', function ($route, $second, $third, $forth) {
        return View::make('ngApp');
    });

});