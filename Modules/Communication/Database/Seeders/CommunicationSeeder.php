<?php

namespace Modules\Communication\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Communication\Entities\Communication;

/**
 * Class CommunicationTableSeeder.
 */
class CommunicationSeeder extends Seeder
{

    /**
     * Run the database seed.
     */
    public function run(): void
    {

        Communication::create([
            'name' => trans('modules/communications/seeders.Messaging'),
            'description' => trans('modules/communications/seeders.Chat messages with doctor'),
            'price'=>10 ,
            'currency'=>'$'
        ]);
        Communication::create([
            'name' => trans('modules/communications/seeders.Voice Call'),
            'description' => trans('modules/communications/seeders.Voice Call with doctor'),
            'price'=>20,
            'currency'=>'$'
        ]);
        Communication::create([
            'name' => trans('modules/communications/seeders.Video Call'),
            'description' => trans('modules/communications/seeders.Video Call with doctor'),
            'price'=>30,
            'currency'=>'$'
        ]);
    }
}
