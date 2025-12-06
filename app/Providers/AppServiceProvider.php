<?php

namespace App\Providers;

use App\Events\CardEvent;
use Illuminate\Support\ServiceProvider;
use Symfony\Contracts\EventDispatcher\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Event::subscribe(CardEvent::class);
    }
}
