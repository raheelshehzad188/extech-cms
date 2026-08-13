<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    public function href(): string
    {
        if (filled($this->route_name)) {
            try {
                return route($this->route_name);
            } catch (\Throwable) {
                // Invalid route name — fall through to URL.
            }
        }

        if (filled($this->url)) {
            if (str_starts_with($this->url, 'http://') || str_starts_with($this->url, 'https://') || str_starts_with($this->url, '#')) {
                return $this->url;
            }

            return url($this->url);
        }

        return '#';
    }

    public static function ensureFooterDefaults(): void
    {
        if (static::query()->where('location', 'footer')->exists()) {
            return;
        }

        $items = [
            ['label' => 'About', 'route_name' => 'about', 'sort_order' => 1],
            ['label' => 'Our Services', 'route_name' => 'services.index', 'sort_order' => 2],
            ['label' => 'Our Blogs', 'route_name' => 'blog.index', 'sort_order' => 3],
            ['label' => 'FAQ’S', 'route_name' => 'faq', 'sort_order' => 4],
            ['label' => 'Contact Us', 'route_name' => 'contact', 'sort_order' => 5],
        ];

        foreach ($items as $item) {
            static::query()->create([
                'label' => $item['label'],
                'route_name' => $item['route_name'],
                'location' => 'footer',
                'is_active' => true,
                'sort_order' => $item['sort_order'],
            ]);
        }
    }
}
