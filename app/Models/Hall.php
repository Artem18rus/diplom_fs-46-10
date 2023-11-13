<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    protected $table = 'halls';
    protected $guarded = false;

    public function seances() {
        return $this->hasMany(Seance::class);
    }
}
