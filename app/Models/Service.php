<?php

namespace App\Models;

use App\Models\Concerns\HasSeo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasSeo;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Service $service) {
            if (blank($service->slug) && filled($service->title)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function imageUrl(): ?string
    {
        return $this->image ? asset('storage/'.$this->image) : null;
    }
}
