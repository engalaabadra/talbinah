<?php

use Illuminate\Support\Facades\Route;
use Modules\Specialty\Http\Controllers\API\Admin\SpecialtyResourceController;

/**************************Routes Specialties***************************** */
Route::resource('specialties', SpecialtyResourceController::class);
Route::post('specialties/{id}', [SpecialtyResourceController::class,'update']);

//another routes for module Specialties
Route::prefix('specialties')->as('specialties')->group(function(){
    //routes  additional for module Specialties
    Route::as('additional')->group(function(){
        
       
    });

    //routes  services for module Specialties
    Route::prefix('services')->as('services')->group(function(){

    });
});

