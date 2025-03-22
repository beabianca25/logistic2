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
        'type',
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
        'destination',
        'duration',
        'included_services',
        'availability',
        'rental_duration_unit',
        'price_per_unit',
        'is_available',
        'status',
    ];
    

    public function bids()
{
    return $this->hasMany(Bid::class);
}

}
