<?php

namespace Robodocxs\LaravelErpMiddleware;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\PhpseclibV3\SftpAdapter;
use Robodocxs\LaravelErpMiddleware\Http\Middleware\AuthenticateOnceWithBasicAuth;
use Robodocxs\LaravelErpMiddleware\Exceptions\CustomExceptionHandler;
use Robodocxs\LaravelErpMiddleware\Console\PublishApiControllerCommand;

class LaravelErpMiddlewareServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/robodocxs-erp-middleware.php', 'sftp'
        );

        $this->app->singleton(
            ExceptionHandler::class,
            CustomExceptionHandler::class
        );
    }

    public function boot()
    {
        $this->app['router']->aliasMiddleware('auth.basic.once', AuthenticateOnceWithBasicAuth::class);

        $this->publishes([
            __DIR__.'/../config/robodocxs-erp-middleware.php' => config_path('robodocxs-erp-middleware.php'),
        ], 'config');

        //$this->loadRoutesFrom(__DIR__.'/routes/api.php');

        if ($this->app->runningInConsole()) {
            $this->commands([
                PublishApiControllerCommand::class,
            ]);
        }
    }
}
