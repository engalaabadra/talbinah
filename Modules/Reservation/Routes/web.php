<?php
use Modules\Reservation\Http\Controllers\WEB\Doctor\ReservationController as ReservationDoctorController;
use Modules\Reservation\Http\Controllers\WEB\User\ReservationController as ReservationUserController;

Route::prefix('doctor')->as('doctor')->group(function(){

    Route::prefix('reservations')->as('reservations')->group(function(){
        Route::get('/report/doctor/{doctorId}',[ReservationDoctorController::class,'getReportReservations'])->name('report');

    });
});

//random link for reservation
Route::get('/prescription',[ReservationUserController::class,'randomLink']);

Route::prefix('reservations')->group(function(){
    Route::get('invoice/{id}',[ReservationUserController::class,'getNotesReservationPdf'])->name('reservations.invoice');
});
