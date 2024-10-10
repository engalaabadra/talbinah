<?php

namespace Modules\Duration\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Duration\Entities\Duration;

/**
 * Class DurationTableSeeder.
 */
class DurationSeeder extends Seeder
{

    /**
     * Run the database seed.
     */
    public function run(): void
    {

        Duration::create([
            'duration' => '15',
        ]);
        Duration::create([
            'duration' => '30',
        ]);
        Duration::create([
            'duration' => '45',
        ]);
        Duration::create([
            'duration' => '60',
            'active'=>0
        ]);
    }
}
