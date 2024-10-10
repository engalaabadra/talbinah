<?php

namespace Modules\Reservation\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Reservation\Entities\ReasonRescheduling;
/**
 * Class ReasonReschedulingTableSeeder.
 */
class ReasonReschedulingSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run(): void
    {
        ReasonRescheduling::create([
            'reason' => trans('modules/reservations/rescheduling/seeders.I am having a schedule clash'),
        ]);
        ReasonRescheduling::create([
            'reason' => trans('modules/reservations/rescheduling/seeders.I am not available on schedule'),
        ]);
        ReasonRescheduling::create([
            'reason' => trans('modules/reservations/rescheduling/seeders.I have a activity that cant be left behind'),
        ]);
        ReasonRescheduling::create([
            'reason' => trans('modules/reservations/rescheduling/seeders.I dont want to tell'),
        ]);
        ReasonRescheduling::create([
            'reason' => trans('modules/reservations/rescheduling/seeders.Others'),
        ]);

        
    }
}
