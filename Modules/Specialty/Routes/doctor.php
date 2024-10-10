<?php
use Modules\Specialty\Http\Controllers\API\Doctor\SpecialtyResourceController;

Route::resource('specialties', SpecialtyResourceController::class)->only(['index','search']);
