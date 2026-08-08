<?php

namespace App\Models;

use App\Models\Concerns\HasSeo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasSeo;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'sections' => 'array',
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Page $page) {
            if (blank($page->slug) && filled($page->title)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
