<?php


namespace App\Services\Question;


use App\Models\QsnModel;
use App\Services\BaseService;

class ModelService extends BaseService
{
    public function model(): string
    {
        return QsnModel::class;
    }
}
