<?php

use Modules\Duration\Http\Controllers\API\DurationResourceController;

Route::prefix('durations')->group(function(){
    Route::get('/all',[DurationResourceController::class,'index'])->name('all');
});
