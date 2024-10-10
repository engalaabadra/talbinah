<?php
use Modules\Keyword\Http\Controllers\API\Admin\KeywordResourceController;

/**************************Routes Keyword***************************** */

Route::resource('keywords', KeywordResourceController::class);
