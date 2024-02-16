<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AuthTableSeeder::class,
            AdminSeeder::class,
            SettingSeeder::class,
            LegalsPageSeeder::class,
            CurrenciesSeeder::class,
            CountriesSeeder::class,
        ]);
    }
}
