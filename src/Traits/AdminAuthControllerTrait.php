<?php

namespace AlphaDeltas\Grampa\Traits;

use AlphaDeltas\Grampa\Jobs\UpdateShopAsGrandfatheredJob;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use OhMyBrew\ShopifyApp\Jobs\ScripttagInstaller;
use OhMyBrew\ShopifyApp\Jobs\WebhookInstaller;
use OhMyBrew\ShopifyApp\Requests\AuthShop;
use OhMyBrew\ShopifyApp\Traits\AuthControllerTrait;

trait AdminAuthControllerTrait
{
    use AuthControllerTrait {
        AuthControllerTrait::index as originalIndex;
        AuthControllerTrait::authenticate as originalAuthenticate;
    }

    /** @inheritDoc */
    public function index()
    {
        $shopDomain = Request::query('shop');

        return View::make('grampa::install_admin', compact('shopDomain'));
    }

    public function authenticate(AuthShop $request)
    {
        //update auth url redirect
        Config::set('shopify-app.api_redirect', '/authenticate-admin');
        //add UpdateShopAsGrandfatheredJob to after_authenticate_job list
        $jobsConfig = Config::get('shopify-app.after_authenticate_job');
        if(isset($jobsConfig['job'])) $jobsConfig = [$jobsConfig]; // in case only one job was specified
        $jobsConfig[] = [
            'job' => UpdateShopAsGrandfatheredJob::class,
            'inline' => true,
        ];
        Config::set('shopify-app.after_authenticate_job', $jobsConfig);
        
        return $this->originalAuthenticate($request);
    }
}
