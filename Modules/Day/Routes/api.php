<?php
use Modules\Day\Http\Controllers\API\User\DayController;
use Modules\Day\Http\Controllers\API\DayResourceController;

Route::resource('days', DayResourceController::class)->only(['index']);

Route::prefix('days')->group(function(){
    Route::get('/doctor/{doctorId}',[DayController::class,'allDaysDoctor'])->name('all-days-doctor');
});
