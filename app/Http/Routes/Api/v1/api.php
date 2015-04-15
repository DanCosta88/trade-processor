<?php


Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1' ], function () {

    Route::post('messages/consume', [
        'as' => 'messageConsumer',
        'uses' => 'MessageController@consume'
    ]);

    Route::resource('messages', 'MessageController');

});
