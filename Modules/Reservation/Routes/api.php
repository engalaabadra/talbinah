<?php
use Modules\Reservation\Http\Controllers\API\User\ReservationResourceController;
use Modules\Reservation\Http\Controllers\API\ReasonCancelation\User\ReasonCancelationResourceController;
use Modules\Reservation\Http\Controllers\API\ReasonRescheduling\User\ReasonReschedulingResourceController;
use Modules\Reservation\Http\Controllers\API\User\ReservationController;
Route::resource('reservations', ReservationResourceController::class)->only(['index','show','store','update','destroy']);
// Route::post('reservations/delete/{id}',[ReservationResourceController::class,'destroy']);
Route::post('reservations/{id}',[ReservationResourceController::class,'update']);
//another routes for module Reservations
Route::prefix('reservations')->as('reservations')->group(function(){
    //routes  additional for module Reservations
    Route::as('additional')->group(function(){
        Route::get('get-notes/{id}',[ReservationController::class,'getNotesReservation']);
        Route::get('check-visit/{reservationId}',[ReservationController::class,'checkVisit'])->name('check-visit');
        Route::get('check-reservation/{reservationId}',[ReservationController::class,'checkReservation'])->name('check-reservation');
    });
});



Route::resource('reasons-cancelation', ReasonCancelationResourceController::class)->only(['index']);

Route::resource('reasons-rescheduling', ReasonReschedulingResourceController::class)->only(['index']);
