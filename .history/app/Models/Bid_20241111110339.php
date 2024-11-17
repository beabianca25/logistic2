<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'auction_id',
        'buyer_id',
        'bid_amount',
        'status',
        'bid_time',
    ];

    // Define relationships
    public function product()
    {
        return $this->belongsTo(Auction::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
