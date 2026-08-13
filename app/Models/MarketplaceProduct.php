<?php

namespace App\Models;

use App\Models\Concerns\HasSeo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class MarketplaceProduct extends Model
{
    use HasSeo;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'gallery' => 'array',
            'features' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (MarketplaceProduct $product) {
            if (blank($product->slug) && filled($product->title)) {
                $product->slug = Str::slug($product->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MarketplaceCategory::class, 'marketplace_category_id');
    }

    public function mediaUrl(?string $path, ?string $fallback = null): ?string
    {
        if (blank($path)) {
            return $fallback ? asset($fallback) : null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        return asset('storage/'.$path);
    }

    public function imageUrl(): string
    {
        return $this->mediaUrl($this->image, 'assets/img/project/01.jpg');
    }

    public function displayPrice(): string
    {
        $amount = $this->sale_price !== null && $this->sale_price !== '' && (float) $this->sale_price > 0
            ? $this->sale_price
            : $this->price;

        return '$'.number_format((float) $amount, 0);
    }

    public function regularPrice(): ?string
    {
        if ($this->sale_price === null || (float) $this->sale_price <= 0) {
            return null;
        }

        if ((float) $this->sale_price >= (float) $this->price) {
            return null;
        }

        return '$'.number_format((float) $this->price, 0);
    }

    public function featureList(): array
    {
        $features = $this->features ?? [];
        $out = [];

        foreach ($features as $feature) {
            if (is_array($feature)) {
                $out[] = (string) ($feature['feature'] ?? reset($feature) ?: '');
            } else {
                $out[] = (string) $feature;
            }
        }

        return array_values(array_filter($out));
    }
}
