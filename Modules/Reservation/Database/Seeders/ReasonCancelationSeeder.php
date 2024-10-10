<?php

namespace Modules\Reservation\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Reservation\Entities\ReasonCancelation;
/**
 * Class ReasonCancelationTableSeeder.
 */
class ReasonCancelationSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run(): void
    {
        ReasonCancelation::create([
            'reason' => trans('modules/reservations/cancelation/seeders.I want to change to another doctor'),
        ]);
        ReasonCancelation::create([
            'reason' => trans('modules/reservations/cancelation/seeders.I want to change package'),
        ]);
        ReasonCancelation::create([
            'reason' => trans('modules/reservations/cancelation/seeders.I dont want to consult'),
        ]);
        ReasonCancelation::create([
            'reason' => trans('modules/reservations/cancelation/seeders.I have recovered from the disease'),
        ]);
        ReasonCancelation::create([
            'reason' => trans('modules/reservations/cancelation/seeders.I have found a suitable medicine'),
        ]);
        ReasonCancelation::create([
            'reason' => trans('modules/reservations/cancelation/seeders.I just want to cancel'),
        ]);
        ReasonCancelation::create([
            'reason' => trans('modules/reservations/cancelation/seeders.I dont want to tell'),
        ]);
        ReasonCancelation::create([
            'reason' => trans('modules/reservations/cancelation/seeders.Others'),
        ]);

        
    }
}
