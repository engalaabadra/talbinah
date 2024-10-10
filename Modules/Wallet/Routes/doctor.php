<?php

use Modules\Wallet\Http\Controllers\API\Doctor\WalletResourceController;
use Modules\Wallet\Http\Controllers\API\Doctor\WalletController;

Route::resource('wallets', WalletResourceController::class)->only(['index']);

//another routes for module wallets
Route::prefix('wallets')->as('wallets')->group(function(){
    //routes  additional for module wallets
    Route::as('additional')->group(function(){
        Route::delete('withdraw', [WalletController::class,'withdraw'])->name('withdraw');

    });
});
