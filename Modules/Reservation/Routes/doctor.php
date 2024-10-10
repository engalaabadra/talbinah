<?php
use Modules\Reservation\Http\Controllers\API\Doctor\ReservationResourceController;
use Modules\Reservation\Http\Controllers\API\Doctor\ReservationController;
use Modules\Reservation\Http\Controllers\API\ReasonCancelation\Doctor\ReasonCancelationResourceController;
use Modules\Reservation\Http\Controllers\API\ReasonRescheduling\Doctor\ReasonReschedulingResourceController;

Route::get('/reports-year',[ReservationController::class,'getReportYearReservations'])->name('report-year');


Route::resource('reservations', ReservationResourceController::class)->only(['index','show','destroy']);
Route::put('reservations/{id}',[ReservationResourceController::class,'update']);

//another routes for module Reservations
Route::prefix('reservations')->as('reservations')->group(function(){
    
    //routes  additional for module Reservations
    Route::as('additional')->group(function(){
        Route::get('/user/{userId}',[ReservationController::class,'getReservationsUser']);
        Route::post('add-notes/{id}',[ReservationController::class,'addNotes']);
        Route::post('update-notes/{id}',[ReservationController::class,'updateNotes']);
        Route::get('get-notes/{id}',[ReservationController::class,'getNotesReservation']);
        Route::post('switch-visit/{reservationId}',[ReservationController::class,'switchVisit'])->name('switch-visit');
        Route::get('check-visit/{reservationId}',[ReservationController::class,'checkVisit'])->name('check-visit');
        Route::get('check-reservation/{reservationId}',[ReservationController::class,'checkReservation'])->name('check-reservation');
    
        Route::get('/reports-year',[ReservationController::class,'getReportYearReservations'])->name('report-year');

    });
});


// Route::resource('reasons-cancelation', ReasonCancelationResourceController::class)->only(['index']);

// Route::get('reasons-rescheduling', [ReasonReschedulingResourceController::class,'index']);
