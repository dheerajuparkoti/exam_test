<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function programs()
    {
        return $this->hasMany(Programs::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany
     */
    public function subFaculties()
    {
        return $this->hasMany(Faculty::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'parent_id', 'id');
    }
}
