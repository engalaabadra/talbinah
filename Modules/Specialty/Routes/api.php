<?php
use Modules\Specialty\Http\Controllers\API\User\SpecialtyResourceController;
use Modules\Specialty\Http\Controllers\API\User\SpecialtyController;

Route::resource('specialties', SpecialtyResourceController::class)->only(['index','search']);
//another routes for module Specialties
Route::prefix('specialties')->as('specialties')->group(function(){
    //routes  additional for module Specialties
    Route::as('additional')->group(function(){
        Route::get('top',[SpecialtyController::class,'getTopSpecialties'])->name('get-top-specialties');
    });
});
