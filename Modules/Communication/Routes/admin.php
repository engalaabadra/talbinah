<?php

use Illuminate\Support\Facades\Route;
use Modules\Communication\Http\Controllers\API\Admin\CommunicationResourceController;

/**************************Routes Communications***************************** */

Route::resource('communications', CommunicationResourceController::class);
Route::post('communications/{id}', [CommunicationResourceController::class,'update']);


