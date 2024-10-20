<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class QsnModel extends Model
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

    // Define the relationship with Question Categories
    public function questionCategories()
    {
        return $this->hasMany(SubjectQuestionCategory::class, 'qsn_model_id');
    }

    protected $table = 'qsn_models'; // Make sure this is the correct table name
    public function histories()
    {
        return $this->hasMany(History::class, 'qsn_model_id');
    }
}
