<?php

use Modules\Appointment\Http\Controllers\API\Doctor\AppointmentResourceController;
use Modules\Appointment\Http\Controllers\API\Doctor\AppointmentController;

Route::resource('appointments', AppointmentResourceController::class);

//another routes for module Appointments
Route::prefix('appointments')->as('appointments')->group(function(){
    //routes  additional for module Appointments
    Route::as('additional')->group(function(){

    });
});
