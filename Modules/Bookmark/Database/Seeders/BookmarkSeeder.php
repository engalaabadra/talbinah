<?php

namespace Modules\Bookmark\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Bookmark\Entities\Bookmark;
/**
 * Class BookmarkTableSeeder.
 */
class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run(): void
    {
        Bookmark::create([
            'user_id' => 3,
            'doctor_id' => 4
        ]);
    }
}
