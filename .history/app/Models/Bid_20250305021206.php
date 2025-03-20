<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
protected $table = 'bids';
protected $fillable = [
    'user_id', 'auction_id', 'bid_amount', 'guest_name', 'guest_email', 'guest_phone'
];


 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Relationships
     */
    // Define relationships
    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
        

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
