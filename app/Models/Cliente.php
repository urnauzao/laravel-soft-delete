<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory; 
    use SoftDeletes;

    protected $fillable = [
        'name',
        'idade',
        'deleted_at'
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}
