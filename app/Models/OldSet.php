<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldSet extends Model
{
    use HasFactory;
    protected $table = 'old_sets';

    protected $fillable = ['image', 'description'];
}
