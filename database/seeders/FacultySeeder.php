<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        notes 
        id 
        id 2 means bachelore level
        id 5 means diploma level
        */
        $faculty = [
            //Engineering Licensingj
            ['name' => 'Science & Technology', 'category_id' => '1', 'level_id' => '1', 'parent_id' => NULL],
        ];

        DB::table('faculties')->insert($faculty);

    }
}
