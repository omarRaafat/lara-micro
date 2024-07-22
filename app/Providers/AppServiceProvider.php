<?php

namespace App\Providers;

use App\Http\Services\SettingsService;
use App\Models\User;
use App\Models\Setting;
use App\Observers\UserObserver;
use App\Http\Services\TwilioService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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

        $this->app->singleton('settings' , function($app){ // connect settings facade class to settings service
            return new SettingsService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(new UserObserver());
      
        Cache::forget('settings');  
             Cache::rememberForever('settings' , function(){
                if(Schema::hasTable('settings'))
                    return Setting::pluck('value' , 'key');
            });
        
    }
}
