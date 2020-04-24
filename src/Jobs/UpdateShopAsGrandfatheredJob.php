<?php

namespace AlphaDeltas\Grampa\Jobs;

use OhMyBrew\ShopifyApp\Models\Shop;
use App\Throttling\ShopifyThrottler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateShopAsGrandfatheredJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Shop */
    private $shop;

    /**
     * Create a new job instance.
     *
     * @param Shop $shop
     */
    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->shop->grandfathered = true;
        $this->shop->save();
    }
}
