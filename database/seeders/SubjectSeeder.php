<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            //License Exam
            //For Computer Engineerng 
            ['name' => 'DSA', 'category_id' => '1', 'level_id' => '1', 'faculty_id' => '1', 'sub_faculty_id' => '2'],
            ['name' => 'OS', 'category_id' => '1', 'level_id' => '1', 'faculty_id' => '1', 'sub_faculty_id' => '2'],
            ['name' => 'DBMS', 'category_id' => '1', 'level_id' => '1', 'faculty_id' => '1', 'sub_faculty_id' => '2'],
            ['name' => 'Simulation & Modeling', 'category_id' => '1', 'level_id' => '1', 'faculty_id' => '1', 'sub_faculty_id' => '2'],
            ['name' => 'Embedded System', 'category_id' => '1', 'level_id' => '1', 'faculty_id' => '1', 'sub_faculty_id' => '2'],
        ];
        DB::table('subjects')->insert($subjects);
    }
}
