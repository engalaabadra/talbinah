<?php

use Modules\ArticleCategory\Http\Controllers\API\Admin\ArticleCategoryResourceController;

/**************************Routes ArticleCategorys***************************** */

Route::resource('articles-categories', ArticleCategoryResourceController::class);