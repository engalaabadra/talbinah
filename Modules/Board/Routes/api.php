<?php

use Modules\Board\Http\Controllers\API\Admin\BoardResourceController as BoardResourceControllerAdmin;
use Modules\Board\Http\Controllers\API\BoardResourceController as BoardResourceControllerUser;

Route::resource('boards', BoardResourceControllerAdmin::class);
Route::resource('boards', BoardResourceControllerUser::class)->only(['index']);
