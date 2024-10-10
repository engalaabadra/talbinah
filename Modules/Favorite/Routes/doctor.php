<?php
use Modules\Favorite\Http\Controllers\API\FavoriteResourceController;
use Modules\Favorite\Http\Controllers\API\FavoriteController;

Route::resource('favorites', FavoriteResourceController::class)->only(['index','store']);
Route::post('favorites/destroy', [FavoriteResourceController::class,'destroy']);
//another routes for module Favorites
Route::prefix('favorites')->as('favorites')->group(function(){
    //routes  additional for module Favorites
    Route::as('additional')->group(function(){

    });
});
