<?php


namespace App\Services;


use App\Models\Subject;

class SubjectService extends BaseService
{
    public function model(): string
    {
        return Subject::class;
    }
}
