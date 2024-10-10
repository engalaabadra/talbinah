<?php

use Modules\Day\Http\Controllers\API\DayResourceController;
use Modules\Day\Http\Controllers\API\Doctor\DayController;

Route::resource('days', DayResourceController::class)->only(['index']);

Route::prefix('days')->group(function(){
    Route::get('appointments/day/{dayId}', [DayController::class,'getAppointmentsDay']);
});
