<?php

namespace Foundation\Providers;

use Domain\Emoji\EmojiServiceProvider;
use Illuminate\Support\ServiceProvider;

final class FoundationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register the EmojiServiceProvider
        $this->app->register(EmojiServiceProvider::class);
    }
}
