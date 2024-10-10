<?php

use Illuminate\Support\Facades\Route;
use Modules\Reservation\Http\Controllers\API\Admin\ReservationResourceController;

/**************************Routes Reservations***************************** */
Route::resource('Reservations', ReservationResourceController::class);
//another routes for module Reservations
Route::prefix('Reservations')->as('Reservations')->group(function(){
    //routes  additional for module Reservations
    Route::as('additional')->group(function(){
        
       
    });

    //routes  services for module Reservations
    Route::prefix('services')->as('services')->group(function(){

    });
});

