<?php
use Modules\Banner\Http\Controllers\API\BannerResourceController;

Route::resource('banners', BannerResourceController::class)->only(['index']);

