<?php


namespace App\Services;

use App\Models\Category;

class CategoryService extends BaseService
{
    public function model(): string
    {
        return Category::class;
    }
}
