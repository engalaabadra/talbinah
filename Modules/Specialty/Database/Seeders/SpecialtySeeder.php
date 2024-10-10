<?php

namespace Modules\Specialty\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Specialty\Entities\Specialty;
/**
 * Class SpecialtyTableSeeder.
 */
class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run(): void
    {
        $Specialty1=Specialty::create([
            "name"=>trans("modules/specialties/seeders.Psychiatrist"),
            "description"=>trans("modules/specialties/seeders.description Psychiatrist"),
            "is_report"=>1
        ]);
        
        
        $Specialty2=Specialty::create([
            "name"=>trans("modules/specialties/seeders.Psychologist"),
            "description"=>trans("modules/specialties/seeders.description Psychologist"),
            "is_report"=>0

        ]);

        $Specialty3=Specialty::create([
            "name"=>trans("modules/specialties/seeders.Social Worker"),
            "description"=>trans("modules/specialties/seeders.description Social Worker"),
            "is_report"=>0

        ]);

        $Specialty4=Specialty::create([
            "name"=>trans("modules/specialties/seeders.Family Physician"),
            "description"=>trans("modules/specialties/seeders.description Family Physician"),
            "is_report"=>1
        ]);
       

        $Specialty1->doctors()->attach([7,9]);
        $Specialty2->doctors()->attach([7,10]);
        $Specialty3->doctors()->attach([8,11]);
        $Specialty4->doctors()->attach([9]);

    }
}
