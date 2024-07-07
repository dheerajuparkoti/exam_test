<?php

namespace App\Services;

use App\Models\Level;

class LevelService extends BaseService
{
    public function model(): string
    {
        return Level::class;
    }

    public function allWithCategory()
    {
        return $this->model::select('levels.*', 'categories.name as category_name')
            ->join('categories', 'levels.category_id', '=', 'categories.id')
            ->get();
    }

}
