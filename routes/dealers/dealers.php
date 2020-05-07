<?php
Route::group(['namespace' => 'Dealers'], function() {
    Route::middleware('auth')->group(function () {
        Route::view('/contract', 'dealers.contract')->middleware('permission:read-dealers');
        //Route::view('/rules', 'dealers.rules')->middleware('permission:read-dealers');
        Route::get('/rules', 'DealerController@rules')->middleware('permission:read-dealers');
        //Route::view('/schedule', 'dealers.schedule')->middleware('permission:read-dealers');
        Route::get('/schedule', 'DealerController@schedule')->middleware('permission:read-dealers');

        // views
        Route::group(['prefix' => 'dealers'], function() {
            Route::view('/', 'dealers.index')->middleware('permission:read-dealers');
            Route::view('/create', 'dealers.create')->middleware('permission:create-dealers');
            Route::view('/{user}/edit', 'dealers.edit')->middleware('permission:update-dealers');
        });

        // api
        Route::group(['prefix' => 'api/dealers'], function() {
            Route::post('/filter', 'DealerController@filter')->middleware('permission:read-dealers');
            Route::post('/uploadAvatar', 'DealerController@uploadAvatar')->middleware('permission:update-dealers');
            Route::post('/activeToggle', 'DealerController@activeToggle')->middleware('permission:update-dealers');
            Route::put('/agree/{user}', 'DealerController@agree')->middleware('permission:update-dealers');

            Route::get('/{user}', 'DealerController@show')->middleware('permission:read-dealers');
            Route::post('/store', 'DealerController@store')->middleware('permission:create-dealers');
            Route::put('/update/{user}', 'DealerController@update')->middleware('permission:update-dealers');
            Route::delete('/{user}', 'DealerController@destroy')->middleware('permission:delete-dealers');
        });
    });
});
