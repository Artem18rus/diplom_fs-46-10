<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    protected $table = 'halls';
    protected $guarded = false;

    // public function sea() {
    //     return $this->hasMany(Seance::class, 'hall_id', 'id');
    // }
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'seances')->withPivot('startTime');;;
    }

}
