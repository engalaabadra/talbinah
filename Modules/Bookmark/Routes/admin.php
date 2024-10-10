<?php

use Illuminate\Support\Facades\Route;
use Modules\Bookmark\Http\Controllers\API\Admin\BookmarkResourceController;

/**************************Routes Bookmarks***************************** */
Route::resource('bookmarks', BookmarkResourceController::class);
//another routes for module Bookmarks
Route::prefix('bookmarks')->as('bookmarks')->group(function(){
    //routes  additional for module Bookmarks
    Route::as('additional')->group(function(){
        
       
    });

    //routes  services for module Bookmarks
    Route::prefix('services')->as('services')->group(function(){

    });
});

