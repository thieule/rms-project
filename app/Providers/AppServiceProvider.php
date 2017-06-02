<?php

namespace App\Providers;
use App\Aspect\ActivityAspect;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ActivityAspect::class, function ($app) {
            return new ActivityAspect($app->make(LoggerInterface::class));
        });

        $this->app->tag([ActivityAspect::class], 'goaop.aspect');
    }

    public function boot()
    {

    }


}
