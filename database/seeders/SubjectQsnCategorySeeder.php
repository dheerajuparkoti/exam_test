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
            ['quantity' => '5', 'qsn_category_id' => '1', 'subject_id' => '1'],
            ['quantity' => '2', 'qsn_category_id' => '3', 'subject_id' => '2'],
            ['quantity' => '3', 'qsn_category_id' => '5', 'subject_id' => '3'],
        ];
        DB::table('subject_qsn_categories')->insert($subQsnCategory);
    }
}
