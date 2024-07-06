<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    public function qsnCategory()
    {
        return $this->belongsTo(QsnCategory::class, 'qsn_category_id');
    }
}
