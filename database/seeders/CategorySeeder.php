<?php

namespace Database\Seeders;

use App\Services\CategoryService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * CategorySeeder constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(
        CategoryService $categoryService
    ) {
        $this->categoryService = $categoryService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Licensing Exam'],
            ['name' => 'Public Service Commision'],
            ['name' => "Entrance Exam"]
        ];

        $this->categoryService->truncate();
        foreach ($categories as $category) {
            $this->categoryService->create($category);
        }
    }
}
