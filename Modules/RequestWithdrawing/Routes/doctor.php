<?php
use Modules\RequestWithdrawing\Http\Controllers\API\Doctor\RequestWithdrawingResourceController;


Route::resource('request-withdrawings', RequestWithdrawingResourceController::class)->only(['index']);

