<?php

namespace App\Services;

use App\Models\Level;

class LevelService extends BaseService
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Level::class;
    }



}
