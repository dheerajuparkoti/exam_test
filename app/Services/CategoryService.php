<?php


namespace App\Services;

use App\Models\Category;

class ExamService extends BaseService
{
    public function model()
    {
        return Category::class;
    }
}
