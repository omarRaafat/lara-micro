<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    protected $model = City::class;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create(
                [
                    'name' => json_encode([
                            'ar' => 'القاهرة',
                            'en'=> 'cairo'
                        ]),
                    'country_id' => 1
                
                ],
                [
                    'name' => json_encode([
                            'ar' => 'الجيزة',
                            'en'=> 'giza'
                        ]),
                    'country_id' => 1
                
                ]
            );
    
   }
}
