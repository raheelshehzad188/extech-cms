<?php

namespace App\Models;

use App\Models\Concerns\HasSeo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasSeo;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'home_1_content' => 'array',
            'home_2_content' => 'array',
            'home_3_content' => 'array',
        ];
    }

    public static function current(): self
    {
        $attributes = Cache::remember('site_settings', 60, function () {
            $settings = static::query()->first() ?? static::query()->create([
                'site_name' => 'Extech',
                'home_template' => 'home-1',
            ]);

            return $settings->getAttributes();
        });

        $model = static::query()->newModelInstance();
        $model->setRawAttributes($attributes, true);
        $model->exists = true;

        return $model;
    }

    public static function flushCache(): void
    {
        Cache::forget('site_settings');
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::flushCache());
        static::deleted(fn () => static::flushCache());
    }

    public function homeContent(): array
    {
        return match ($this->home_template) {
            'home-2' => $this->home_2_content ?? [],
            'home-3' => $this->home_3_content ?? [],
            default => $this->home_1_content ?? [],
        };
    }

    public function homeView(): string
    {
        return match ($this->home_template) {
            'home-2' => 'frontend.home.home-2',
            'home-3' => 'frontend.home.home-3',
            default => 'frontend.home.home-1',
        };
    }

    public function googleFontsUrl(): string
    {
        $title = str_replace(' ', '+', $this->font_title ?: 'Rajdhani');
        $body = str_replace(' ', '+', $this->font_body ?: 'Plus Jakarta Sans');

        return "https://fonts.googleapis.com/css2?family={$title}:wght@400;500;600;700&family={$body}:wght@300;400;500;600;700&display=swap";
    }

    public function logoUrl(): string
    {
        return $this->logo
            ? asset('storage/'.$this->logo)
            : asset('assets/img/logo.svg');
    }

    /**
     * Header "Get A Quote" CTA. Legacy /contact defaults go to the quote form.
     */
    public function headerCtaUrl(): string
    {
        $url = trim((string) $this->header_cta_url);

        if ($url === '' || in_array(trim($url, '/'), ['contact'], true)) {
            return route('quote');
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        return url($url);
    }

    public function faviconUrl(): string
    {
        return $this->favicon
            ? asset('storage/'.$this->favicon)
            : asset('assets/img/favicon.svg');
    }

    public function preloaderGifUrl(): ?string
    {
        return $this->preloader_gif
            ? asset('storage/'.$this->preloader_gif)
            : null;
    }

    public static function mediaUrl(?string $path, string $fallback = ''): string
    {
        if (blank($path)) {
            return $fallback ? asset($fallback) : '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        return asset('storage/'.$path);
    }

    public function defaultBannerUrl(): string
    {
        return $this->default_banner
            ? asset('storage/'.$this->default_banner)
            : asset('assets/img/breadcrumb.jpg');
    }

    /**
     * Individual banner pehle, warna general site banner.
     */
    public function resolveBanner(?string $individualBanner = null): string
    {
        if (filled($individualBanner)) {
            return str_starts_with($individualBanner, 'http') || str_starts_with($individualBanner, '/')
                ? $individualBanner
                : asset('storage/'.$individualBanner);
        }

        return $this->defaultBannerUrl();
    }
}
