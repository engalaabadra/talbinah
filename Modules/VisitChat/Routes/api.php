<?php
use Modules\VisitChat\Http\Controllers\API\User\VisitChatResourceController;
use Modules\VisitChat\Http\Controllers\API\User\VisitChatController;

Route::resource('visits-chats', VisitChatResourceController::class)->only(['index','store']);

//another routes for module visits-chats
Route::prefix('visits-chats')->as('visits-chats')->group(function(){
    //routes  additional for module visits-chats
    Route::as('additional')->group(function(){
         });
});
