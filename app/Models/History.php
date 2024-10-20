<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_qsn',
        'skipped_qsn',
        'answered_qsn',
        'obtained_marks',
        'correct_count',
        'user_id',
        'qsn_model_id'
    ];
    // Define the relationship with the QsnModel
    public function qsnModel()
    {
        return $this->belongsTo(QsnModel::class, 'qsn_model_id', 'id');
    }


}
