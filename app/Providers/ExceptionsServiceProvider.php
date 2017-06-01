<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class ExceptionsServiceProvider - Hacky?!
 * @package App\Providers
 */
class ExceptionsServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(){}

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        app('Dingo\Api\Exception\Handler')->register(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
        });
    }
}