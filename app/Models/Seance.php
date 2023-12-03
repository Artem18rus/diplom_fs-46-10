<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;
    protected $table = 'seances';
    protected $guarded = false;

    // public function movies() {
    //     return $this->hasMany(Movie::class);
    // }

    // public function halls() {
    //     return $this->hasMany(Hall::class, 'hall_id', 'id');
    // }

    // public function sean() {
    //         return $this->belongsTo(Hall::class);
    // }
}
