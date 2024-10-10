<?php

use Illuminate\Support\Facades\Route;
use Modules\ArticleCategory\Http\Controllers\API\ArticleCategoryResourceController;

/**************************Routes ArticleCategorys***************************** */

Route::resource('articles-categories', ArticleCategoryResourceController::class)->only(['index']);

