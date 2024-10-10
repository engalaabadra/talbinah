<?php
/**************************Auth************************************* */
use App\Http\Controllers\API\Auth\Doctor\LoginController;
use App\Http\Controllers\API\Auth\Doctor\RegisterController;
use Modules\Reservation\Http\Controllers\API\ReasonRescheduling\Doctor\ReasonReschedulingResourceController;
use Modules\Reservation\Http\Controllers\API\ReasonCancelation\Doctor\ReasonCancelationResourceController;

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/login', [LoginController::class, 'login'])->name('login');

//logout
Route::middleware(['auth:api'])->group(function(){
    Route::delete('/logout', [LoginController::class, 'destroy']);
});

Route::get('reasons-rescheduling', [ReasonReschedulingResourceController::class,'index']);
Route::get('reasons-cancelation', [ReasonCancelationResourceController::class,'index']);
