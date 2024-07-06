<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QsnCategory extends Model
{
    use HasFactory;
    public function subQsnCategories()
    {
        return $this->hasMany(SubjectQsnCategory::class, 'qsn_category_id');
    }

    public function questions()
    {
        return $this->hasMany(Questions::class);
    }

}
