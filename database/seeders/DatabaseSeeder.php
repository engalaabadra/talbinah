<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GeocodeDatabaseSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(BoardDatabaseSeeder::class);
        $this->call(BannerDatabaseSeeder::class);
        $this->call(ReviewDatabaseSeeder::class);
        $this->call(ReservationDatabaseSeeder::class);
        $this->call(SpecialtyDatabaseSeeder::class);
        $this->call(TimeDatabaseSeeder::class);
        $this->call(DurationDatabaseSeeder::class);
        $this->call(DayDatabaseSeeder::class);
        $this->call(CommunicationDatabaseSeeder::class);
        $this->call(PaymentDatabaseSeeder::class);
        $this->call(ProfileDatabaseSeeder::class);
        $this->call(AppointmentDatabaseSeeder::class);
        $this->call(ArticleCategoryDatabaseSeeder::class);
        $this->call(ArticleDatabaseSeeder::class);
    }
}

