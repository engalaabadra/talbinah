<?php

namespace Modules\VisitCall\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\VisitCall\Entities\VisitCall;
/**
 * Class VisitCallTableSeeder.
 */
class VisitCallSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run(): void
    {
        VisitCall::create([
            'user_id' => 3,
            'doctor_id' => 4
        ]);
    }
}
