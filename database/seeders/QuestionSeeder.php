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

        foreach (range(1, 15) as $index) {
            DB::table('questions')->insert([
                'title' => $faker->name,
                'description' => $faker->firstNameFemale(),
                'option' => $faker->colorName(),
                'qsn_model_id' => '1',
                'qsn_category_id' => $faker->numberBetween(4, 5),
                'subject_id' => $faker->numberBetween(2, 3),
            ]);
        }
    }
}
