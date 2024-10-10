<?php
use Modules\Bookmark\Http\Controllers\API\BookmarkResourceController;

Route::resource('bookmarks', BookmarkResourceController::class)->only(['index','store']);
Route::post('bookmarks/destroy', [BookmarkResourceController::class,'destroy']);

Route::delete('bookmarks', [BookmarkResourceController::class,'destroy']);
