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
        $faculties = [
            //Engineering Licensingj
            ['name' => 'Engineering', 'category_id' => 1, 'level_id' => 1, 'parent_id' => NULL],
            ['name' => 'Nursing', 'category_id' => 1, 'level_id' => 1, 'parent_id' => NULL],
        ];
        $subFaculties = [
            ['name' => 'Computer', 'category_id' => 1, 'level_id' => 1, 'parent_id' => 1],
            ['name' => 'Civil', 'category_id' => 1, 'level_id' => 1, 'parent_id' => 1],
        ];

        DB::table('faculties')->truncate();
        DB::table('faculties')->insert($faculties);
        DB::table('faculties')->insert($subFaculties);


    }
}
