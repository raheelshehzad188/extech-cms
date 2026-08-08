<?php

namespace App\Models\Concerns;

trait HasSeo
{
    public static function seoFillable(): array
    {
        return [
            'meta_title',
            'meta_description',
            'meta_keywords',
            'meta_author',
            'og_title',
            'og_description',
            'og_image',
            'og_type',
            'twitter_title',
            'twitter_description',
            'twitter_image',
            'twitter_card',
            'canonical_url',
            'robots',
            'schema_markup',
        ];
    }

    public function seoTitle(?string $fallback = null): string
    {
        return $this->meta_title
            ?: $fallback
            ?: (string) ($this->title ?? $this->name ?? config('app.name'));
    }

    public function seoDescription(?string $fallback = null): string
    {
        return $this->meta_description
            ?: $fallback
            ?: (string) ($this->excerpt ?? $this->short_description ?? '');
    }

    public function seoKeywords(): string
    {
        return (string) ($this->meta_keywords ?? '');
    }

    public function seoImage(): ?string
    {
        $image = $this->og_image ?: $this->twitter_image ?: ($this->image ?? $this->thumbnail ?? null);

        if (! $image) {
            return null;
        }

        return str_starts_with($image, 'http') ? $image : asset('storage/'.$image);
    }
}
