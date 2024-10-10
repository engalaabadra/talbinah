<?php

namespace Modules\Day\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Day\Entities\Day;

/**
 * Class DayTableSeeder.
 */
class DaySeeder extends Seeder
{

    /**
     * Run the database seed.
     */
    public function run(): void
    {

        Day::create([
            'name' => trans('modules/days/seeders.Saturday'),
            'day_id'=>6

        ]);
        Day::create([
            'name' => trans('modules/days/seeders.Sunday'),
            'day_id'=>7
        ]);
        Day::create([
            'name' => trans('modules/days/seeders.Monday'),
            'day_id'=>1
        ]);
        Day::create([
            'name' => trans('modules/days/seeders.Tuesday'),
            'day_id'=>2
        ]);
        Day::create([
            'name' => trans('modules/days/seeders.Wednesday'),
            'day_id'=>3
        ]);
        Day::create([
            'name' => trans('modules/days/seeders.Thursday'),
            'day_id'=>4
        ]);
        Day::create([
            'name' => trans('modules/days/seeders.Friday'),
            'day_id'=>5
        ]);
        
    }
}
