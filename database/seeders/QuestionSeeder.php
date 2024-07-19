<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            DB::table('questions')->insert([
                'title' => $faker->name(),
                'description' => $faker->firstNameFemale(),
                'options' => json_encode([ // Convert the array to a JSON string
                    [
                        'option' => $faker->name(),
                        'is_correct' => 1,
                    ],
                    [
                        'option' => $faker->firstName(),
                        'is_correct' => 0,
                    ],
                    [
                        'option' => $faker->lastName(),
                        'is_correct' => 0,
                    ],
                    [
                        'option' => $faker->colorName(),
                        'is_correct' => 0,
                    ],
                ]),
                'category_id' => 1,
                'level_id' => 1,
                'faculty_id' => 1,
                'sub_faculty_id' => 3,
                'subject_id' => rand(1,3),
                'qsn_category_id' => 1,
            ]);
        }
    }
}
