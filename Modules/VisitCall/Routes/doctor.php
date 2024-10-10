<?php

use Modules\VisitCall\Http\Controllers\API\Doctor\VisitCallResourceController;
use Modules\VisitCall\Http\Controllers\API\Doctor\VisitCallController;

Route::resource('visits-calls', VisitCallResourceController::class)->only(['index','store']);

//another routes for module visits-calls
Route::prefix('visits-calls')->as('visits-calls')->group(function(){
    //routes  additional for module visits-calls
    Route::as('additional')->group(function(){
         });
});
