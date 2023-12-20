<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickChair extends Model
{
    use HasFactory;
    
    protected $table = 'pick_chairs';
    protected $guarded = false;
}
