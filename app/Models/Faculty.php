<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'level_id'];

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
}
