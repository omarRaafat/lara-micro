<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Palestine'],
            ['key' => 'description', 'value' => 'Palestine Will be free.'],
            ['key' => 'keyword', 'value' => 'palestine, aqsa, jerusalem, occupation'],
            ['key' => 'admin_email', 'value' => 'admin@admin.com'],
            ['key' => 'posts_per_page', 'value' => 10],
            ['key' => 'users_can_register', 'value' => true],
        ];

        Setting::insert($settings);
    }
}
