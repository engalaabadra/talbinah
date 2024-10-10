<?php
use Modules\Communication\Http\Controllers\API\CommunicationResourceController;

Route::resource('communications', CommunicationResourceController::class)->only(['index']);
