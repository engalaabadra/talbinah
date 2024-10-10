<?php

use Illuminate\Support\Facades\Route;
use Modules\Article\Http\Controllers\API\ArticleResourceController;
use Modules\Article\Http\Controllers\API\ArticleController;
/**************************Routes Articles***************************** */

Route::resource('articles', ArticleResourceController::class)->only(['index','search']);

//another routes for module articles
Route::prefix('articles')->as('articles')->group(function(){
    //routes  additional for module articles
    Route::as('additional')->group(function(){
        Route::get('category/{categoryId}', [ArticleController::class,'getArticlesCategory']); 
        Route::get('newest', [ArticleController::class,'getNewestArticles']);
        Route::get('trending', [ArticleController::class,'getTrendingArticles']); 

       
    });

});