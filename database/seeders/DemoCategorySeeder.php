<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DemoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $demoCategory = [
        //     ['name' => 'Pooja Bahini', 'category_id' => '1'],
        //     ['name' => 'Devendra Vai', 'category_id' => '1'],
        //     ['name' => 'Samikshya', 'category_id' => '2'],
        //     ['name' => 'Pushpa', 'category_id' => '2'],
        // ];

        // DB::table('demo_categories')->insert($demoCategory);



        $faker = Faker::create();

        foreach (range(1, 1000) as $index) {
            DB::table('demo_categories')->insert([
                'name' => $faker->name,
                'category_id' => $faker->numberBetween(1, 2),
            ]);
        }

    }
}
