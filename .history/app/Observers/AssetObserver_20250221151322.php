<?php

namespace App\Observers;

use App\Models\Asset;
use App\Events\AssetStockUpdated;

class AssetObserver
{
    public function created(Asset $asset)
    {
        event(new AssetStockUpdated($asset));
    }

    public function updated(Asset $asset)
    {
        event(new AssetStockUpdated($asset));
    }
}
