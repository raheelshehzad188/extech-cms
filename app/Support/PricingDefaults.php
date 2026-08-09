<?php

namespace App\Support;

use App\Models\PricingPlan;
use App\Models\SiteSetting;
use Illuminate\Support\Collection;

class PricingDefaults
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function plans(): array
    {
        return [
            [
                'name' => 'Regular Plans',
                'monthly_price' => '$49',
                'yearly_price' => '$399',
                'monthly_suffix' => '/ Month',
                'yearly_suffix' => '/ Year',
                'button_text' => 'Get Started Now',
                'button_url' => '/contact',
                'card_style' => 'style1',
                'is_highlighted' => false,
                'is_published' => true,
                'sort_order' => 1,
                'features' => [
                    ['text' => '100 GB SSD Storage', 'included' => true],
                    ['text' => 'Weekly Backups', 'included' => true],
                    ['text' => 'Unlimited Free SSL', 'included' => true],
                    ['text' => '24/7 system Monitoring', 'included' => true],
                    ['text' => 'Free Domain ($9.99 value)', 'included' => true],
                    ['text' => 'Frame 164236', 'included' => false],
                    ['text' => '20+ Payment Methods', 'included' => false],
                ],
            ],
            [
                'name' => 'Standard Plans',
                'monthly_price' => '$79',
                'yearly_price' => '$649',
                'monthly_suffix' => '/ Month',
                'yearly_suffix' => '/ Year',
                'button_text' => 'Get Started Now',
                'button_url' => '/contact',
                'card_style' => 'style2',
                'is_highlighted' => true,
                'is_published' => true,
                'sort_order' => 2,
                'features' => [
                    ['text' => '100 GB SSD Storage', 'included' => true],
                    ['text' => 'Weekly Backups', 'included' => true],
                    ['text' => 'Unlimited Free SSL', 'included' => true],
                    ['text' => '24/7 system Monitoring', 'included' => true],
                    ['text' => 'Free Domain ($9.99 value)', 'included' => true],
                    ['text' => 'Priority Support', 'included' => true],
                    ['text' => '20+ Payment Methods', 'included' => true],
                ],
            ],
            [
                'name' => 'Premium Plans',
                'monthly_price' => '$99',
                'yearly_price' => '$849',
                'monthly_suffix' => '/ Month',
                'yearly_suffix' => '/ Year',
                'button_text' => 'Get Started Now',
                'button_url' => '/contact',
                'card_style' => 'style1',
                'is_highlighted' => false,
                'is_published' => true,
                'sort_order' => 3,
                'features' => [
                    ['text' => '100 GB SSD Storage', 'included' => true],
                    ['text' => 'Weekly Backups', 'included' => true],
                    ['text' => 'Unlimited Free SSL', 'included' => true],
                    ['text' => '24/7 system Monitoring', 'included' => true],
                    ['text' => 'Free Domain ($9.99 value)', 'included' => true],
                    ['text' => 'Dedicated Manager', 'included' => true],
                    ['text' => '20+ Payment Methods', 'included' => true],
                ],
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function sectionTitles(): array
    {
        return [
            'pricing_subtitle' => 'Our Pricing',
            'pricing_title' => 'Our Awesome Pricing Plans',
            'pricing_monthly_label' => 'Monthly',
            'pricing_yearly_label' => 'Yearly',
            'pricing_save_text' => 'Save 25%',
        ];
    }

    /**
     * @return Collection<int, PricingPlan>
     */
    public static function apply(bool $replaceExisting = true): Collection
    {
        if ($replaceExisting) {
            PricingPlan::query()->delete();
        }

        if (! $replaceExisting && PricingPlan::query()->exists()) {
            return PricingPlan::query()->orderBy('sort_order')->get();
        }

        foreach (self::plans() as $plan) {
            PricingPlan::query()->create($plan);
        }

        $settings = SiteSetting::query()->first() ?? SiteSetting::current();

        foreach (['home_1_content', 'home_2_content', 'home_3_content'] as $key) {
            $content = $settings->{$key} ?? [];
            $settings->{$key} = array_merge($content, self::sectionTitles());
        }

        $settings->save();
        SiteSetting::flushCache();

        return PricingPlan::query()->orderBy('sort_order')->get();
    }
}
