<?php

namespace App\Providers;

use App\Models\MailSetting;
use Illuminate\Support\ServiceProvider;

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
        try {
            if ($this->app->runningInConsole() && ! $this->app->runningUnitTests()) {
                // Still apply for queue workers / artisan mail commands.
            }

            MailSetting::current()->applyToConfig();
        } catch (\Throwable) {
            // DB may not be ready during install/migrate.
        }
    }
}
