<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'name',
        'date',
        'prioritas',
    ];
}
