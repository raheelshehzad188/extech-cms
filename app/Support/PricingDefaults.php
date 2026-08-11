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
                'monthly_price' => '$649',
                'yearly_price' => null,
                'monthly_suffix' => 'One Time',
                'yearly_suffix' => null,
                'button_text' => 'Buy Now',
                'button_url' => null,
                'card_style' => 'style1',
                'is_highlighted' => false,
                'is_published' => true,
                'sort_order' => 1,
                'features' => [
                    ['text' => '1-5 Web Pages', 'included' => true],
                    ['text' => 'Theme Setup', 'included' => true],
                    ['text' => 'Mobile-Friendly', 'included' => true],
                    ['text' => 'Basic SEO', 'included' => true],
                    ['text' => 'Contact Form', 'included' => true],
                    ['text' => 'Priority Support', 'included' => false],
                    ['text' => 'Dedicated Manager', 'included' => false],
                ],
            ],
            [
                'name' => 'Standard Plans',
                'monthly_price' => '$949',
                'yearly_price' => null,
                'monthly_suffix' => 'One Time',
                'yearly_suffix' => null,
                'button_text' => 'Buy Now',
                'button_url' => null,
                'card_style' => 'style2',
                'is_highlighted' => true,
                'is_published' => true,
                'sort_order' => 2,
                'features' => [
                    ['text' => '1-10 Web Pages', 'included' => true],
                    ['text' => 'Custom Responsive UI/UX', 'included' => true],
                    ['text' => 'Complete SEO', 'included' => true],
                    ['text' => '3 Revisions', 'included' => true],
                    ['text' => 'Contact Form', 'included' => true],
                    ['text' => 'Priority Support', 'included' => true],
                    ['text' => 'Dedicated Manager', 'included' => false],
                ],
            ],
            [
                'name' => 'Premium Plans',
                'monthly_price' => '$1249',
                'yearly_price' => null,
                'monthly_suffix' => 'One Time',
                'yearly_suffix' => null,
                'button_text' => 'Buy Now',
                'button_url' => null,
                'card_style' => 'style1',
                'is_highlighted' => false,
                'is_published' => true,
                'sort_order' => 3,
                'features' => [
                    ['text' => '100 GB SSD Storage', 'included' => true],
                    ['text' => 'Weekly Backups', 'included' => true],
                    ['text' => 'Unlimited Free SSL', 'included' => true],
                    ['text' => '24/7 system Monitoring', 'included' => true],
                    ['text' => 'Free Domain', 'included' => true],
                    ['text' => 'Dedicated Manager', 'included' => true],
                    ['text' => 'Priority Support', 'included' => true],
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
            unset($content['pricing_monthly_label'], $content['pricing_yearly_label'], $content['pricing_save_text']);
            $settings->{$key} = array_merge($content, self::sectionTitles());
        }

        $settings->save();
        SiteSetting::flushCache();

        return PricingPlan::query()->orderBy('sort_order')->get();
    }
}
