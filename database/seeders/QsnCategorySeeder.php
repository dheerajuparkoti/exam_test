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
            ['name' => 'very short', 'weightage' => '1', 'isObjective' => '1'],
            ['name' => 'very short', 'weightage' => '1', 'isObjective' => '0'],
            ['name' => 'short', 'weightage' => '2', 'isObjective' => '1'],
            ['name' => 'short', 'weightage' => '2', 'isObjective' => '0'],
            ['name' => 'medium', 'weightage' => '3', 'isObjective' => '0'],
            ['name' => 'long', 'weightage' => '5', 'isObjective' => '0'],
            ['name' => 'long', 'weightage' => '7', 'isObjective' => '0'],
            ['name' => 'very long', 'weightage' => '8', 'isObjective' => '0'],
            ['name' => 'very long', 'weightage' => '10', 'isObjective' => '0'],
        ];
        DB::table('qsn_categories')->insert($qsnCategory);
    }
}
