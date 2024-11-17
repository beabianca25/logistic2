<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{

    use HasFactory;
    protected $table = 'auctions';

    protected $fillable = [
        'category',
        'auction_title',
        'year',
        'description',
        'condition',
        'product_version',
        'company',
        'photo',
        'min_estimate_price',
        'max_estimate_price',
        'end_date',
    ];
}
