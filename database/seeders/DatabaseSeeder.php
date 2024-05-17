<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            ResellerSeeder::class,
            SiteSettingSeeder::class,
            AboutSeeder::class,
            AdministratorSeeder::class,
            // ProductSeeder::class,
            SlideSeeder::class,
            BannerSeeder::class,
            TermPrivacySeeder::class,
        ]);
    }
}
