<?php
use Modules\Time\Http\Controllers\API\User\TimeController;

Route::prefix('times')->group(function(){
    Route::get('/day/{dayId}/duration/{durationId}/doctor/{doctorId}',[TimeController::class,'alltimesDay'])->name('all-times-day');
});
