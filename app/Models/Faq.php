<?php

namespace App\Models;

use App\Models\Concerns\HasSeo;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasSeo;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }
}
