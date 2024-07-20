<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QsnModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $qsnModel = [
            ['name' => 'First Model', 'full_mark' => '100', 'pass_mark' => '40', 'time_limit' => '180', 'is_default' => '0', 'category_id' => 1, 'level_id' => 1, 'faculty_id' => 1, 'sub_faculty_id' => 3],
            ['name' => 'Second Model', 'full_mark' => '50', 'pass_mark' => '20', 'time_limit' => '90', 'is_default' => '0', 'category_id' => 1, 'level_id' => 1, 'faculty_id' => 1, 'sub_faculty_id' => 3],
            ['name' => 'Third Model', 'full_mark' => '150', 'pass_mark' => '60', 'time_limit' => '240', 'is_default' => '0', 'category_id' => 1, 'level_id' => 1, 'faculty_id' => 1, 'sub_faculty_id' => 3],
        ];
        DB::table('qsn_models')->truncate();
        DB::table('qsn_models')->insert($qsnModel);
    }
}
