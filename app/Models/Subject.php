<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Subject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * @return BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    /**
     * @return BelongsTo
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    /**
     * @return BelongsTo
     */
    public function subFaculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    public function qsnModel()
    {
        return $this->belongsTo(QsnModel::class, 'qsn_model_id');
    }

    /**
     * @return BelongsToMany
     */
    public function questionCategories()
    {
        return $this->belongsToMany(QsnCategory::class, 'subject_qsn_categories', 'subject_id', 'qsn_category_id')->using(SubjectQuestionCategory::class)->withPivot('id', 'min', 'max', 'qsn_model_id');
    }


}
