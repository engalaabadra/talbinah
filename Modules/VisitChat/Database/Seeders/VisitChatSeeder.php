<?php

namespace Modules\VisitChat\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\VisitChat\Entities\VisitChat;
/**
 * Class VisitChatTableSeeder.
 */
class VisitChatSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run(): void
    {
        VisitChat::create([
            'user_id' => 3,
            'doctor_id' => 4
        ]);
    }
}
