<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QsnCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $qsnCategory = [
            ['name' => 'very short', 'weightage' => '1', 'is_objective' => '1'],
            ['name' => 'short', 'weightage' => '2', 'is_objective' => '1'],
            ['name' => 'short', 'weightage' => '2', 'is_objective' => '0'],
            ['name' => 'short', 'weightage' => '3', 'is_objective' => '0'],
            ['name' => 'long', 'weightage' => '5', 'is_objective' => '0'],
            ['name' => 'long', 'weightage' => '7', 'is_objective' => '0'],
            ['name' => 'very long', 'weightage' => '8', 'is_objective' => '0'],
            ['name' => 'very long', 'weightage' => '10', 'is_objective' => '0'],
        ];
        DB::table('qsn_categories')->truncate();
        DB::table('qsn_categories')->insert($qsnCategory);
    }
}
