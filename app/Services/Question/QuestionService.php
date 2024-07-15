<?php


namespace App\Services\Question;


use App\Models\Questions;
use App\Services\BaseService;

class QuestionService extends BaseService
{
    public function model(): string
    {
        return Questions::class;
    }
}
