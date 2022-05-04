<?php

namespace App\Services;

use App\Models\Buyer;
use Illuminate\Support\Facades\Cache;

class BuyerService
{
    public function cacheBuyerCount()
    {
        Cache::forget("buyer_count");
        Cache::rememberForever("buyer_count", function () {
            return Buyer::count();
        });
    }
}
