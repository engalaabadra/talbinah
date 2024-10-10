<?php
use Modules\Bookmark\Http\Controllers\API\BookmarkResourceController;
use Modules\Bookmark\Http\Controllers\API\BookmarkController;

Route::resource('bookmarks', BookmarkResourceController::class)->only(['index','store']);
Route::post('bookmarks/destroy', [BookmarkResourceController::class,'destroy']);
