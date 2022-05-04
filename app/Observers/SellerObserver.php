<?php

namespace App\Observers;

use Facades\App\Services\SellerService;

class SellerObserver
{
    public function created()
    {
        SellerService::cacheSellerCount();
    }

    public function deleted()
    {
        SellerService::cacheSellerCount();
    }
}
