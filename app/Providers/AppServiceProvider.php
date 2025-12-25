<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AiClientInterface;
use App\Services\GeminiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AiClientInterface::class,
            GeminiClient::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}