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
            ['name' => 'Second Model', 'full_mark' => '100', 'pass_mark' => '40', 'time_limit' => '30', 'is_default' => '0', 'category_id' => '1', 'level_id' => '1', 'faculty_id' => '1', 'sub_faculty_id' => '1'],
        ];
        DB::table('qsn_models')->insert($qsnModel);
    }
}
