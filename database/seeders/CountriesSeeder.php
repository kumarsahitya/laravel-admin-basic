<?php

namespace Database\Seeders;

use App\Traits\Database\DisableForeignKeys;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    use DisableForeignKeys;

    protected array $countries;

    public function __construct()
    {
        $this->countries = include __DIR__.'/countries.php';
    }

    public function run(): void
    {
        $this->disableForeignKeys();

        foreach ($this->countries as $key => $country) {
            \App\Models\admin\System\Country::query()->create([
                'name' => $country['name']['common'],
                'name_official' => $country['name']['official'],
                'cca2' => $country['cca2'],
                'cca3' => $country['cca3'],
                'flag' => $country['flag'],
                'latitude' => $country['latlng'][0],
                'longitude' => $country['latlng'][1],
                'currencies' => $country['currencies'],
            ]);
        }

        $this->enableForeignKeys();
    }
}
