<?php

use Modules\Keyword\Http\Controllers\API\KeywordResourceController;
use Modules\Keyword\Http\Controllers\API\KeywordController;

Route::resource('keywords', KeywordResourceController::class)->only(['index','search']);

//another routes for module Keywords
Route::prefix('keywords')->as('keywords')->group(function(){
    //routes  additional for module Keywords
    Route::as('additional')->group(function(){
        Route::get('category/{categoryId}', [KeywordController::class,'getKeywordsCategory']); 
        Route::get('newest', [KeywordController::class,'getNewestKeywords']); 
        Route::get('trending', [KeywordController::class,'getTrendingKeywords']); 
       
    });
});
