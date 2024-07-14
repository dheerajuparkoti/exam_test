<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectQuestionCategory extends Pivot
{
    use HasFactory;
    protected $table = 'subject_qsn_categories';

    public function model() {
        return $this->belongsTo(QsnModel::class, 'qsn_model_id', 'id');
    }
}
