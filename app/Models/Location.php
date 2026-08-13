<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public const MAX_COUNT = 4;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->orderBy('sort_order');
    }

    public static function canAddMore(): bool
    {
        return static::query()->count() < self::MAX_COUNT;
    }

    public function flagUrl(): ?string
    {
        if (blank($this->flag)) {
            return null;
        }

        if (str_starts_with($this->flag, 'http://') || str_starts_with($this->flag, 'https://')) {
            return $this->flag;
        }

        if (str_starts_with($this->flag, 'assets/')) {
            return asset($this->flag);
        }

        return asset('storage/'.$this->flag);
    }
}
