<?php

namespace App\Providers;

use App\Models\MenuItem;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('frontend.*', function ($view) {
            $settings = SiteSetting::current();
            $headerMenu = MenuItem::query()
                ->where('location', 'header')
                ->whereNull('parent_id')
                ->where('is_active', true)
                ->with('children')
                ->orderBy('sort_order')
                ->get();

            $view->with([
                'settings' => $settings,
                'headerMenu' => $headerMenu,
            ]);
        });
    }
}
