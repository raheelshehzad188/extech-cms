<?php

namespace App\Models;

use App\Models\Concerns\HasSeo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasSeo;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'project_date' => 'date',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Project $project) {
            if (blank($project->slug) && filled($project->title)) {
                $project->slug = Str::slug($project->title);
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
