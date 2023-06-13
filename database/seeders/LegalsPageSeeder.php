<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Traits\Database\DisableForeignKeys;

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
         * Refund Policy.
         */
        \App\Models\Admin\Legal::query()->create([
            'title' => $title = __('Refund policy'),
            'slug' => str_slug($title),
            'is_enabled' => true,
            'content' => null,
        ]);

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

        /*
         * Terms of uses.
         */
        \App\Models\Admin\Legal::query()->create([
            'title' => $title = __('Shipping policy'),
            'slug' => str_slug($title),
            'is_enabled' => true,
            'content' => null,
        ]);

        $this->enableForeignKeys();
    }
}
