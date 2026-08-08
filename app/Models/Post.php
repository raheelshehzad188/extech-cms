<?php

namespace App\Models;

use App\Models\Concerns\HasSeo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasSeo;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Post $post) {
            if (blank($post->slug) && filled($post->title)) {
                $post->slug = Str::slug($post->title);
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
