<?php

use Illuminate\Support\Facades\Route;
use Modules\Appointment\Http\Controllers\API\Admin\AppointmentResourceController;

/**************************Routes Appointments***************************** */
Route::resource('Appointments', AppointmentResourceController::class);
//another routes for module Appointments
Route::prefix('Appointments')->as('Appointments')->group(function(){
    //routes  additional for module Appointments
    Route::as('additional')->group(function(){
        
       
    });

    //routes  services for module Appointments
    Route::prefix('services')->as('services')->group(function(){

    });
});

