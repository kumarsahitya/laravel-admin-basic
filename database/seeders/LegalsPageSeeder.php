<?php

namespace Database\Seeders;

use App\Traits\Database\DisableForeignKeys;
use Illuminate\Database\Seeder;

class LegalsPageSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        /*
         * Privacy Policy.
         */
        \App\Models\Admin\Legal::query()->create([
            'title' => $title = __('Privacy policy'),
            'slug' => str_slug($title),
            'is_enabled' => true,
            'content' => null,
        ]);

        /*
         * Terms of uses.
         */
        \App\Models\Admin\Legal::query()->create([
            'title' => $title = __('Terms of use'),
            'slug' => str_slug($title),
            'is_enabled' => true,
            'content' => null,
        ]);

        $this->enableForeignKeys();
    }
}
