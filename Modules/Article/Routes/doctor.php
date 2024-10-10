<?php

use Modules\Article\Http\Controllers\API\ArticleResourceController;
use Modules\Article\Http\Controllers\API\ArticleController;

Route::resource('articles', ArticleResourceController::class)->only(['index','search']);

//another routes for module Articles
Route::prefix('articles')->as('articles')->group(function(){
    //routes  additional for module Articles
    Route::as('additional')->group(function(){
        Route::get('category/{categoryId}', [ArticleController::class,'getArticlesCategory']); 
        Route::get('newest', [ArticleController::class,'getNewestArticles']); 
        Route::get('trending', [ArticleController::class,'getTrendingArticles']); 
       
    });
});
