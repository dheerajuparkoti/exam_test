<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    public $guarded=['id'];

    /**
     * @return HasMany
     */
    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    /**
     * @return HasMany
     */
    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }
}
