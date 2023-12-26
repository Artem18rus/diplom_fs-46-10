<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPagesClient extends Model
{
    use HasFactory;
    protected $table = 'status_pages_clients';
    protected $guarded = false;
}
