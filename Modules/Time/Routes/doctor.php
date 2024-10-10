<?php

use Modules\Time\Http\Controllers\API\Doctor\TimeController;

Route::prefix('times')->group(function(){
    Route::get('/all',[TimeController::class,'all'])->name('times');
    Route::get('/day/{dayId}/duration/{durationId}',[TimeController::class,'alltimesDay'])->name('all-times-day');

});
