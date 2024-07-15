<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Questions extends Model
{
    use HasFactory;
    protected $table = 'questions'; // Replace with your actual table name
    protected $casts = [
        'options' => 'array'
    ];
    protected $guarded = ['id'];
    // Define the relationship to QsnCategory
    public function qsnCategory()
    {
        return $this->belongsTo(QsnCategory::class, 'qsn_category_id');
    }
    /**
     * @return BelongsTo
     */
    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
