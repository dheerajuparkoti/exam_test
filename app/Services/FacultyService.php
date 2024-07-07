<?php


namespace App\Services;


use App\Models\Faculty;

class FacultyService extends BaseService
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Faculty::class;
    }
}
