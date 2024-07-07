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
            ['full_mark' => '15', 'pass_mark' => '5', 'time_limit' => '30', 'category_id' => '1', 'level_id' => '1', 'faculty_id' => '1', 'program_id' => '4'],
        ];
        DB::table('qsn_models')->insert($qsnModel);
    }
}
