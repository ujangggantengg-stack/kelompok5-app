<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        Vite::prefetch(concurrency: 3);

        // Share unread message count with Admin Layout
        \Illuminate\Support\Facades\View::composer('layouts.app', function ($view) {
            $count = \App\Models\ChatMessage::where('sender_type', 'user')
                ->where('is_read', false)
                ->count();
            $view->with('unreadMessagesCount', $count);
        });
    }
}
