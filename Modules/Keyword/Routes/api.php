<?php

use Illuminate\Support\Facades\Route;
use Modules\Keyword\Http\Controllers\API\KeywordResourceController;
use Modules\Keyword\Http\Controllers\API\KeywordController;
/**************************Routes Keywords***************************** */

Route::resource('keywords', KeywordResourceController::class)->only(['index','search']);

//another routes for module keywords
Route::prefix('keywords')->as('keywords')->group(function(){
    //routes  additional for module keywords
    Route::as('additional')->group(function(){
        Route::get('category/{categoryId}', [KeywordController::class,'getKeywordsCategory']); 
        Route::get('newest', [KeywordController::class,'getNewestKeywords']);
        Route::get('trending', [KeywordController::class,'getTrendingKeywords']); 

       
    });

    //routes  services for module keywords
    Route::prefix('services')->as('services')->group(function(){

    });
});