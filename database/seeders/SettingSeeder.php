<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'name' => 'Laravel Admin Basic',
            'legal_name' => 'Laravel Admin Basic',
            'email' => 'support@laraveladmin.com',
            'logo' => '',
            'favicon' => '',
            'about' => '',
            'country_id' => '',
            'currency_id' => '',
            'street_address' => '',
            'zipcode' => '',
            'city' => '',
            'phone_number' => '',
            'facebook_link' => '',
            'instagram_link' => '',
            'twitter_link' => '',
            'youtube_link' => '',
            'whatsapp_link' => '',
            'android_url' => '',
            'ios_url' => '',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keyword' => '',
        ];
        foreach ($names as $name => $value) {
            \App\Models\Admin\System\Setting::query()->create([
                'key' => $name,
                'value' => $value,
            ]);
        }
    }
}
