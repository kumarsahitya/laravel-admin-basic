<?php

namespace Database\Seeders;

use App\Traits\Database\DisableForeignKeys;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    use DisableForeignKeys;

    protected array $currencies;

    public function __construct()
    {
        $this->currencies = include __DIR__.'/currencies.php';
    }

    public function run(): void
    {
        $this->disableForeignKeys();

        foreach ($this->currencies as $code => $currency) {
            $data = array_merge($currency, ['code' => $code]);
            \App\Models\admin\System\Currency::query()->create($data);
        }

        $this->enableForeignKeys();
    }
}
