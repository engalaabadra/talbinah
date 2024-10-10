<?php
use Modules\Duration\Http\Controllers\API\DurationController;
use Modules\Duration\Http\Controllers\API\DurationResourceController;

Route::resource('durations', DurationResourceController::class)->only('index');
