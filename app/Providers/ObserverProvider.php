<?php

namespace App\Providers;

use App\Models\Buyer;
use App\Models\Seller;
use App\Observers\BuyerObserver;
use App\Observers\SellerObserver;
use Illuminate\Support\ServiceProvider;

class ObserverProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Buyer::observe(BuyerObserver::class);
        Seller::observe(SellerObserver::class);
    }
}
