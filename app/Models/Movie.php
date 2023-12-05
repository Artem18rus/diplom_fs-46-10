<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'movies';
    protected $guarded = false;

    // public function movies() {
    //     return $this->hasMany(Movie::class);
    // }
    public function halls()
    {
        return $this->belongsToMany(Hall::class, 'seances');
    }
}
