<?php
use Modules\Profile\Http\Controllers\API\Doctor\ProfileController;
use Modules\Profile\Http\Controllers\API\User\ProfileController as ProfileUserController;

Route::prefix('profile')->as('profile.')->group(function(){
    Route::get('show', [ProfileController::class,'show'])->name('show');
    Route::get('show/{userId}', [ProfileUserController::class,'show'])->name('show');
    Route::post('update', [ProfileController::class,'update'])->name('update');
    Route::post('update-password', [ProfileController::class,'updatePassword'])->name('update-password');
});

