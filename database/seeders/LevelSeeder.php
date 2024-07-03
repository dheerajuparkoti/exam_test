<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $levels = [          
            ['name' => 'Bachelore level', 'category_id' => 1],
            ['name' => 'Diploma level', 'category_id' => 1],
            ['name' => '7th level', 'category_id' => 2],
            ['name' => '5th level', 'category_id' => 2],
            ['name' => '4th level', 'category_id' => 2],
        ];

        // Insert data into the 'levels' table
        DB::table('levels')->insert($levels);
    }
}
