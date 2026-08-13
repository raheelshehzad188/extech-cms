<?php

namespace App\Providers;

use App\Models\Location;
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

            $footerLocations = collect();

            try {
                $footerLocations = Location::query()->published()->take(Location::MAX_COUNT)->get();
            } catch (\Throwable) {
                // Table may not exist before migrate.
            }

            $footerMenu = collect();

            try {
                $footerMenu = MenuItem::query()
                    ->where('location', 'footer')
                    ->whereNull('parent_id')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();
            } catch (\Throwable) {
                // Table may not exist before migrate.
            }

            $footerBottomMenu = collect();

            try {
                $footerBottomMenu = MenuItem::query()
                    ->where('location', 'footer_bottom')
                    ->whereNull('parent_id')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();
            } catch (\Throwable) {
                //
            }

            $view->with([
                'settings' => $settings,
                'headerMenu' => $headerMenu,
                'footerMenu' => $footerMenu,
                'footerBottomMenu' => $footerBottomMenu,
                'footerLocations' => $footerLocations,
            ]);
        });
    }
}
