<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
