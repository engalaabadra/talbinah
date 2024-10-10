<?php

use Modules\Auth\Http\Controllers\API\User\DoctorController;
Route::prefix('doctors')->as('doctors.')->group(function(){
    Route::get('/',[DoctorController::class,'index'])->name('all');
    Route::get('top',[DoctorController::class,'getAllTopDoctors'])->name('top');
});
