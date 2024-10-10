<?php
use Modules\Article\Http\Controllers\API\Admin\ArticleResourceController;

/**************************Routes Article***************************** */

Route::resource('articles', ArticleResourceController::class);
Route::post('articles/update/{id}', [ArticleResourceController::class,'update']);
