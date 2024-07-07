<?php


namespace App\Services\Question;


use App\Models\QsnCategory;
use App\Services\BaseService;

class CategoryService extends BaseService
{
    public function model(): string
    {
        return QsnCategory::class;
    }
}
