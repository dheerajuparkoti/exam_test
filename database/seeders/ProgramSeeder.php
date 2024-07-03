<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $program = [
            //Licensing Programs
            // for Science & Technology
            ['name' => 'Civil Engineering', 'faculty_id' => '1'],
            ['name' => 'Electrical Engineering', 'faculty_id' => '1'],
            ['name' => 'Mechanical Engineering', 'faculty_id' => '1'],
            ['name' => 'Computer Engineering', 'faculty_id' => '1'],
            ['name' => 'Aeronautical Engineering', 'faculty_id' => '1'],
            ['name' => 'Agricultural Engineering', 'faculty_id' => '1'],
            ['name' => 'Food Technology', 'faculty_id' => '1'],
            ['name' => 'Biotechnology', 'faculty_id' => '1'],
            ['name' => 'Biochemical Engineering', 'faculty_id' => '1'],
            ['name' => 'Biomedical Engineering', 'faculty_id' => '1'],
            ['name' => 'Bsc. Physics', 'faculty_id' => '1'],
            ['name' => 'CSIT', 'faculty_id' => '1'],
            ['name' => 'BIT', 'faculty_id' => '1'],
            ['name' => 'Software Engineering', 'faculty_id' => '1'],

            //for Management
            ['name' => 'Business Administration', 'faculty_id' => '2'],
            ['name' => 'Business Studies', 'faculty_id' => '2'],
            ['name' => 'Business Management', 'faculty_id' => '2'],
            ['name' => 'Business Economics', 'faculty_id' => '2'],
            ['name' => 'Business Finance', 'faculty_id' => '2'],
            ['name' => 'Business Law', 'faculty_id' => '2'],
            ['name' => 'Business Marketing', 'faculty_id' => '2'],
            ['name' => 'Business Accounting', 'faculty_id' => '2'],
            ['name' => 'Hotel Management', 'faculty_id' => '2'],
            ['name' => 'Tourism Management', 'faculty_id' => '2'],
            ['name' => 'Hospitality Management', 'faculty_id' => '2'],
            ['name' => 'Travel and Tourism Management', 'faculty_id' => '2'],
            ['name' => 'Tourism and Hospitality Management', 'faculty_id' => '2'],
            ['name' => 'Computer Information Management', 'faculty_id' => '2'],
            ['name' => 'Information Management', 'faculty_id' => '2'],
            ['name' => 'Halth Care Management', 'faculty_id' => '2'],





            // for Health Science
            ['name' => 'Nursing', 'faculty_id' => '3'],
            ['name' => 'Medical Laboratory Technology', 'faculty_id' => '3'],
            ['name' => 'Medical Imaging Technology', 'faculty_id' => '3'],
            ['name' => 'Medical Laboratory Technology', 'faculty_id' => '3'],
            ['name' => 'Science in Biochemistry', 'faculty_id' => '3'],
            ['name' => 'Science in Microbiology', 'faculty_id' => '3'],
            ['name' => 'Science in Zoology', 'faculty_id' => '3'],
            ['name' => 'Science in Botany', 'faculty_id' => '3'],
            ['name' => 'Public Health', 'faculty_id' => '3'],
            ['name' => 'Public Health Nursing', 'faculty_id' => '3'],
            ['name' => 'Optometry', 'faculty_id' => '3'],
            ['name' => 'Dental Hygiene', 'faculty_id' => '3'],
            ['name' => 'Dental Technology', 'faculty_id' => '3'],
            ['name' => 'Dental Surgery', 'faculty_id' => '3'],
            ['name' => 'Dental Medicine', 'faculty_id' => '3'],
            ['name' => 'Dental Science', 'faculty_id' => '3'],
            ['name' => 'Physiotherapy', 'faculty_id' => '3'],
            ['name' => 'Pharmacy', 'faculty_id' => '3'],
            ['name' => 'Pharmaceutical Science', 'faculty_id' => '3'],
            ['name' => 'Pharmaceutical Technology', 'faculty_id' => '3'],
            ['name' => 'Pharmaceutical Chemistry', 'faculty_id' => '3'],




            // for Humanities & Socialscience
            ['name' => 'English', 'faculty_id' => '4'],
            ['name' => 'History', 'faculty_id' => '4'],
            ['name' => 'Political Science', 'faculty_id' => '4'],
            ['name' => 'Economics', 'faculty_id' => '4'],
            ['name' => 'Sociology', 'faculty_id' => '4'],
            ['name' => 'Psychology', 'faculty_id' => '4'],
            ['name' => 'Philosophy', 'faculty_id' => '4'],
            ['name' => 'Geography', 'faculty_id' => '4'],
            ['name' => 'Anthropology', 'faculty_id' => '4'],
            ['name' => 'Development Studies', 'faculty_id' => '4'],
            ['name' => 'Religious Studies', 'faculty_id' => '4'],
            ['name' => 'Enterpreneurship Development', 'faculty_id' => '4'],
            ['name' => 'Communication Studies', 'faculty_id' => '4'],
            ['name' => 'Cultural Studies', 'faculty_id' => '4'],
            ['name' => 'Gender Studies', 'faculty_id' => '4'],
            ['name' => 'Peace and Conflict Studies', 'faculty_id' => '4'],
            ['name' => 'BALLB', 'faculty_id' => '4'],
            ['name' => 'Arts', 'faculty_id' => '4'],




            //PSC programs 
            //for civil Faculty only
            ['name' => 'General', 'faculty_id' => '5'],
            ['name' => 'Highway', 'faculty_id' => '5'],
            ['name' => 'Building Construction', 'faculty_id' => '5'],
            ['name' => 'Water Supply & Sanitation', 'faculty_id' => '5'],
            ['name' => 'Surveying', 'faculty_id' => '5'],
            ['name' => 'Irrigation', 'faculty_id' => '5'],

        ];
        DB::table('programs')->insert($program);
    }
}
