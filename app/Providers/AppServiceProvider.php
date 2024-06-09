<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Setting;
use App\Observers\UserObserver;
use App\Http\Services\TwilioService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
        $this->app->bind(TwilioService::class, function ($app) {
            return new TwilioService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(new UserObserver());
      
             Cache::rememberForever('settings' , function(){
                return Setting::pluck('value' , 'key');
            });
        
    }
}
