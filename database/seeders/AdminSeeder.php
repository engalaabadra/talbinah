<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Database\Seeders\LaratrustSeeder;
use Modules\Geocode\Database\Seeders\GeocodeDatabaseSeeder;
use Modules\Board\Database\Seeders\BoardDatabaseSeeder;
use Modules\Banner\Database\Seeders\BannerDatabaseSeeder;
use Modules\Review\Database\Seeders\ReviewDatabaseSeeder;
use Modules\Reservation\Database\Seeders\ReservationDatabaseSeeder;
use Modules\Specialty\Database\Seeders\SpecialtyDatabaseSeeder;
use Modules\Time\Database\Seeders\TimeDatabaseSeeder;
use Modules\Duration\Database\Seeders\DurationDatabaseSeeder;
use Modules\Communication\Database\Seeders\CommunicationDatabaseSeeder;
use Modules\Payment\Database\Seeders\PaymentDatabaseSeeder;
use Modules\Profile\Database\Seeders\ProfileDatabaseSeeder;
use Modules\Appointment\Database\Seeders\AppointmentDatabaseSeeder;
use Modules\Day\Database\Seeders\DayDatabaseSeeder;
use Modules\Article\Database\Seeders\ArticleDatabaseSeeder;
use Modules\ArticleCategory\Database\Seeders\ArticleCategoryDatabaseSeeder;
class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         Admin::create([
            'name' => 'Ehab Elsese',
            'phone' => '0560708092',
            'password' => Hash::make('123456'),
            'email' => 'user@talbinah.com',
        ]);
    }
}

