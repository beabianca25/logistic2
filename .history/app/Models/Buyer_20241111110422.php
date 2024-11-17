<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $table = 'buyers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role',
        'status'
    ];
    public function bids()
{
    return $this->hasMany(Bid::class);
}

}
