<?php

namespace Modules\Appointment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Appointment\Entities\Appointment;
/**
 * Class AppointmentTableSeeder.
 */
class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run(): void
    {
        //users:3,4,5,6
        //doctors:7,8,9,10,11
        Appointment::create([
            'doctor_id' => 7,
            'day_id' => 1,
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);
        Appointment::create([
            'doctor_id' => 7,
            'day_id' => 2,
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);
        Appointment::create([
            'doctor_id' => 7,
            'day_id' => 1,
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);
        Appointment::create([
            'doctor_id' => 8,
            'day_id' => 1,
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);

        Appointment::create([
            'doctor_id' => 8,
            'day_id' => 1,
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);


        Appointment::create([
            'doctor_id' => 9,
            'day_id' => 1,
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);
        Appointment::create([
            'doctor_id' => 9,
            'day_id' => 1,
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);
        Appointment::create([
            'doctor_id' => 10,
            'day_id' => 1,
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);
        Appointment::create([
            'doctor_id' => 10,
            'day_id' => 1,
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);

        Appointment::create([
            'doctor_id' => 10,
            'day_id' => 1,
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);
        
    }
}
