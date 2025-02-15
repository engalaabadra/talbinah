<?php

namespace Modules\Reservation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ReservationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ReservationSeeder::class);
        $this->call(ReasonCancelationSeeder::class);
        $this->call(ReasonReschedulingSeeder::class);
    }
}
