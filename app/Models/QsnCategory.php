<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class QsnCategory extends Model
{
    use HasFactory;
    protected $table = 'qsn_categories';
    protected $guarded = ['id'];
    public function subQsnCategories()
    {
        return $this->hasMany(SubjectQsnCategory::class, 'qsn_category_id');
    }



    public function questions()
    {
        return $this->hasMany(Questions::class);
    }

    /**
     * @return BelongsToMany
     */
    public function questionCategories() {
        return $this->belongsToMany(Subject::class, 'subject_qsn_categories', 'subject_id', 'qsn_category_id')->withPivot('id', 'min', 'max', 'qsn_model_id');
    }

}
