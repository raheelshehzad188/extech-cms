<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function logoUrl(): string
    {
        if (blank($this->logo)) {
            return asset('assets/img/brand.png');
        }

        if (str_starts_with($this->logo, 'assets/')) {
            return asset($this->logo);
        }

        return asset('storage/'.$this->logo);
    }
}
