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
            ['name' => 'DSA', 'program_id' => '4'],
            ['name' => 'OS', 'program_id' => '4'],
            ['name' => 'OOSE', 'program_id' => '4'],
            ['name' => 'DBMS', 'program_id' => '4'],
            ['name' => 'Computer Architecture', 'program_id' => '4'],
            ['name' => 'Microprocessor', 'program_id' => '4'],
            ['name' => 'Web Technology', 'program_id' => '4'],
            ['name' => 'Mathematics I', 'program_id' => '4'],
            ['name' => 'Embedded System', 'program_id' => '4'],
        ];
        DB::table('subjects')->insert($subjects);
    }
}
