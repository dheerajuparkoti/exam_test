<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectQsnCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subQsnCategory = [
            // First Model
            // DSA
            ['min' => '10', 'max' => '20', 'qsn_category_id' => 1, 'subject_id' => 1, 'qsn_model_id' => 1],
            ['min' => '5', 'max' => '10', 'qsn_category_id' => 2, 'subject_id' => 1, 'qsn_model_id' => 1],
            // OS
            ['min' => '12', 'max' => '15', 'qsn_category_id' => 1, 'subject_id' => 2, 'qsn_model_id' => 1],
            ['min' => '5', 'max' => '10', 'qsn_category_id' => 2, 'subject_id' => 2, 'qsn_model_id' => 1],
            // DBMS
            ['min' => '10', 'max' => '20', 'qsn_category_id' => 1, 'subject_id' => 3, 'qsn_model_id' => 1],
            ['min' => '4', 'max' => '8', 'qsn_category_id' => 2, 'subject_id' => 3, 'qsn_model_id' => 1],

            // Second Model
            // DSA
            ['min' => '20', 'max' => '30', 'qsn_category_id' => 1, 'subject_id' => 1, 'qsn_model_id' => 2],
            ['min' => '10', 'max' => '20', 'qsn_category_id' => 2, 'subject_id' => 1, 'qsn_model_id' => 2],
            // OS
            ['min' => '12', 'max' => '30', 'qsn_category_id' => 1, 'subject_id' => 2, 'qsn_model_id' => 2],
            ['min' => '8', 'max' => '20', 'qsn_category_id' => 2, 'subject_id' => 2, 'qsn_model_id' => 2],
        ];
        DB::table('subject_qsn_categories')->truncate();
        DB::table('subject_qsn_categories')->insert($subQsnCategory);
    }
}
