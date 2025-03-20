<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id', 'report_title', 'report_details', 'report_type', 'status', 'report_date'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
