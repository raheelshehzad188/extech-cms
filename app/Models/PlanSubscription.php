<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanSubscription extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'confirmed_at' => 'datetime',
        ];
    }

    public function pricingPlan(): BelongsTo
    {
        return $this->belongsTo(PricingPlan::class);
    }

    public function markConfirmed(): void
    {
        $this->forceFill([
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ])->save();
    }
}
