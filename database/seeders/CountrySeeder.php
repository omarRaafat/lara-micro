<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create([
            'name' => json_encode([
                'ar' => 'مصر',
                'en' => 'Egypt'

            ]),
            'code' => 'EG'
        ]);
    }
}
