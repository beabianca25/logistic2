<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapV extends Model
{
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'status'
    ];
}
