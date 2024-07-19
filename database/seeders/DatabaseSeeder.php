<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $this->call(CategorySeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(QsnCategorySeeder::class);
        $this->call(QsnModelSeeder::class);
        $this->call(SubjectQsnCategorySeeder::class);
        $this->call(QuestionSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
