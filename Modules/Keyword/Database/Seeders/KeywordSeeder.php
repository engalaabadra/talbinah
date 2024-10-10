<?php

namespace Modules\Keyword\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Keyword\Entities\Keyword;
/**
 * Class KeywordTableSeeder.
 */
class KeywordSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run(): void
    {
    
        $Keyword1 = Keyword::create([
            'name' => trans("keywords.seeders.COVID-19")
        ]);
        $Keyword2 = Keyword::create([
            'name' => trans("keywords.seeders.Health")
        ]);
        $Keyword3 = Keyword::create([
            'name' => trans("keywords.seeders.Study")
        ]);

        $Keyword1->articles()->attach([1,2]);
        $Keyword2->articles()->attach([1]);
        $Keyword3->articles()->attach([1,2]);
        
    }
}
