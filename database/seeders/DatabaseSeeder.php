<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\SettingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(20)->create();
        // Post::factory(5)->create();
        $this->call([
            // RolesPermissionsSeeder::class,
            AreaSeeder::class,
            CitySeeder::class,
            CountrySeeder::class,
            WarehouseSeeder::class,
            WarehouseAreaSeeder::class,
            SettingSeeder::class,
            OrderSeeder::class,
            PostSeeder::class
        ]
        );
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
