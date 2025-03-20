<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorReview extends Model
{



    protected $fillable = [
        'vendor_id',
        'reviewer_name',
        'review_text',
        'rating',
        'reviewed_at',
    ];

    /**
     * Get the vendor that owns the review.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
