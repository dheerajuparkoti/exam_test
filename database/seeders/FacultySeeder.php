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
       $faculty=[        
        //Engineering Licensingj
        ['name'=>'Science & Technology','category_id'=>'1'],
        ['name'=>'Management','category_id'=>'1'],
        ['name'=>'Health Sciences','category_id'=>'1'],
        ['name'=>'Humanities & Social Sciences','category_id'=>'1'],
        //PSC for Engineering only.
        ['name'=>'Civil Engineering','category_id'=>'2'],
        ['name'=>'Computer Engineering','category_id'=>'2'],
        ['name'=>'Electrical Engineering','category_id'=>'2'],
        ['name'=>'Mechanical Engineering','category_id'=>'2'],
        ['name'=>'Electronics Engineering','category_id'=>'2'],
        ['name'=>'Chemical Engineering','category_id'=>'2'],
        ['name'=>'Petroleum Engineering','category_id'=>'2'],
        ['name'=>'Architecture','category_id'=>'2'],
        ['name'=>'Agriculture','category_id'=>'2'],       

       ];

       DB::table('faculties')->insert($faculty);

    }
}
