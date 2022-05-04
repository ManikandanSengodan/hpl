<?php

namespace App\Services;

use App\Models\Seller;
use Illuminate\Support\Facades\Cache;

class SellerService
{
    public function cacheSellerCount()
    {
        Cache::forget("seller_count");
        Cache::rememberForever("seller_count", function () {
            return Seller::count();
        });
    }
}
