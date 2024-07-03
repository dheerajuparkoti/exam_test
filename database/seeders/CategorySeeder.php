<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        //for inserting single data
        // DB::table('categories')->insert([
        //     'name' => 'public service commision'
        // ]);

        //for inserting multiple data in a single column
        $categories = [
            ['name' => 'Licensing Exam'],
            ['name' => 'Public Service Commision'],         
            // Add more categories as needed
        ];

        // Insert data into the 'categories' table
        DB::table('categories')->insert($categories);        
    }
}
