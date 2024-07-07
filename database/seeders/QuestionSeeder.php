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
                'title' => $faker->name,
                'description' => $faker->firstNameFemale(),
                'option_a' => $faker->colorName(),
                'option_b' => $faker->lastName(),
                'option_c' => $faker->firstNameMale(),
                'option_d' => $faker->firstName(),
                'correct_option' => 'a',
                'qsn_category_id' => $faker->numberBetween(1, 3),
                'subject_id' => $faker->numberBetween(1, 3),
                'qsn_model_id' => null
            ]);
        }
    }
}
