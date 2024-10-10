<?php

use Modules\Review\Http\Controllers\API\Doctor\ReviewResourceController;
use Modules\Review\Http\Controllers\API\Doctor\ReviewController;

Route::resource('reviews', ReviewResourceController::class)->only('paginate');

//another routes for module Reviews
Route::prefix('reviews')->as('reviews')->group(function(){
    //routes  additional for module Reviews
    Route::as('additional')->group(function(){

    });
});
