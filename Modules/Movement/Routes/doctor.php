<?php

use Modules\Movement\Http\Controllers\API\Doctor\MovementResourceController;
use Modules\Movement\Http\Controllers\API\Doctor\MovementController;

Route::resource('movements', MovementResourceController::class)->only(['index']);

//another routes for module movements
Route::prefix('movements')->as('movements')->group(function(){
    //routes  additional for module movements
    Route::as('additional')->group(function(){

    });
});
