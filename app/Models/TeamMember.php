<?php

namespace App\Models;

use App\Models\Concerns\HasSeo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    use HasSeo;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (TeamMember $member) {
            if (blank($member->slug) && filled($member->name)) {
                $member->slug = Str::slug($member->name);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function imageUrl(): ?string
    {
        return $this->image ? asset('storage/'.$this->image) : asset('assets/img/team/01.jpg');
    }
}
