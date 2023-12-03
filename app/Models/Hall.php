<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    protected $table = 'halls';
    protected $guarded = false;

    // public function seance() {
    //     return $this->belongsTo(Seance::class);
    // }

    public function sea() {
        return $this->hasMany(Seance::class, 'hall_id', 'id');
    }

}
