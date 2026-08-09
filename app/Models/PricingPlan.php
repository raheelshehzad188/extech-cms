<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_highlighted' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function iconUrl(): string
    {
        return $this->icon
            ? asset('storage/'.$this->icon)
            : asset('assets/img/icon/pricingIcon1_1.svg');
    }

    /**
     * @return array<int, array{text: string, included: bool}>
     */
    public function featureList(): array
    {
        $features = $this->features ?? [];

        return collect($features)
            ->map(function ($feature) {
                if (is_string($feature)) {
                    return ['text' => $feature, 'included' => true];
                }

                return [
                    'text' => (string) ($feature['text'] ?? $feature['feature'] ?? ''),
                    'included' => (bool) ($feature['included'] ?? true),
                ];
            })
            ->filter(fn (array $feature) => $feature['text'] !== '')
            ->values()
            ->all();
    }

    public function cardClass(): string
    {
        if ($this->is_highlighted) {
            return 'style2';
        }

        return in_array($this->card_style, ['style1', 'style2'], true)
            ? $this->card_style
            : 'style1';
    }

    public function buttonClass(): string
    {
        return $this->is_highlighted || $this->card_style === 'style2'
            ? 'gt-btn style3 w-100'
            : 'gt-btn style2 w-100';
    }
}
