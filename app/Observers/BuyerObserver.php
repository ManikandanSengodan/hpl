<?php

namespace App\Observers;

use Facades\App\Services\BuyerService;

class BuyerObserver
{
    public function created()
    {
        BuyerService::cacheBuyerCount();
    }

    public function deleted()
    {
        BuyerService::cacheBuyerCount();
    }
}
