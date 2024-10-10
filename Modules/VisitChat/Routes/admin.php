<?php

use Illuminate\Support\Facades\Route;
use Modules\VisitChat\Http\Controllers\API\Admin\VisitChatResourceController;

/**************************Routes VisitChats***************************** */
Route::resource('visits-chats', VisitChatResourceController::class);
//another routes for module VisitChats
Route::prefix('visits-chats')->as('visits-chats')->group(function(){
    //routes  additional for module VisitChats
    Route::as('additional')->group(function(){
        
       
    });

    //routes  services for module VisitChats
    Route::prefix('services')->as('services')->group(function(){

    });
});

