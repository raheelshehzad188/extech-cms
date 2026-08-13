<?php

namespace App\Support;

use App\Models\MarketplaceCategory;
use App\Models\MarketplaceProduct;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Support\Collection;

class MarketplaceDefaults
{
    /**
     * Create dummy marketplace categories/products only when the catalog is empty.
     *
     * @return Collection<int, MarketplaceProduct>
     */
    public static function apply(): Collection
    {
        if (MarketplaceProduct::query()->exists()) {
            return MarketplaceProduct::query()->get();
        }

        $categories = [
            'web' => MarketplaceCategory::query()->firstOrCreate(
                ['slug' => 'web-development'],
                ['name' => 'Web Development', 'is_published' => true, 'sort_order' => 1]
            ),
            'seo' => MarketplaceCategory::query()->firstOrCreate(
                ['slug' => 'seo'],
                ['name' => 'SEO', 'is_published' => true, 'sort_order' => 2]
            ),
            'crm' => MarketplaceCategory::query()->firstOrCreate(
                ['slug' => 'crm'],
                ['name' => 'CRM', 'is_published' => true, 'sort_order' => 3]
            ),
            'design' => MarketplaceCategory::query()->firstOrCreate(
                ['slug' => 'ui-ux'],
                ['name' => 'UI/UX Design', 'is_published' => true, 'sort_order' => 4]
            ),
        ];

        $products = [
            [
                'title' => 'Starter Website Package',
                'slug' => 'starter-website-package',
                'category' => 'web',
                'price' => 79,
                'sale_price' => null,
                'sku' => 'WEB-START-01',
                'image' => 'assets/img/project/01.jpg',
                'short' => '1–5 page conversion-focused website with mobile-friendly design.',
                'features' => ['1-5 Web Pages', 'Mobile-Friendly Design', 'Contact Forms', 'Basic On-Page SEO'],
            ],
            [
                'title' => 'Business Website Package',
                'slug' => 'business-website-package',
                'category' => 'web',
                'price' => 149,
                'sale_price' => 99,
                'sku' => 'WEB-BIZ-02',
                'image' => 'assets/img/project/03.jpg',
                'short' => 'Custom UI/UX website with complete on-page SEO and admin panel.',
                'features' => ['1-10 Web Pages', 'Custom UI/UX', 'Complete On-Page SEO', 'Free Admin Panel'],
            ],
            [
                'title' => 'SEO Growth Kit',
                'slug' => 'seo-growth-kit',
                'category' => 'seo',
                'price' => 199,
                'sale_price' => null,
                'sku' => 'SEO-GROW-03',
                'image' => 'assets/img/project/02.jpg',
                'short' => 'Technical SEO audit, meta optimization, and Search Console setup.',
                'features' => ['Complete SEO Audit', 'Meta Tag Optimization', 'Core Web Vitals', 'Search Console Setup'],
            ],
            [
                'title' => 'Custom CRM Starter',
                'slug' => 'custom-crm-starter',
                'category' => 'crm',
                'price' => 299,
                'sale_price' => 249,
                'sku' => 'CRM-START-04',
                'image' => 'assets/img/service/details-1.jpg',
                'short' => 'Lightweight CRM to manage leads, follow-ups, and client records.',
                'features' => ['Lead Management', 'Contact Database', 'Task Follow-ups', 'Email Alerts'],
            ],
            [
                'title' => 'UI/UX Design Sprint',
                'slug' => 'ui-ux-design-sprint',
                'category' => 'design',
                'price' => 129,
                'sale_price' => null,
                'sku' => 'UX-SPRINT-05',
                'image' => 'assets/img/project/10.jpg',
                'short' => 'Wireframes, high-fidelity screens, and a clickable prototype.',
                'features' => ['User Research', 'Wireframes', 'UI Screens', 'Interactive Prototype'],
            ],
            [
                'title' => 'Shopify Store Launch',
                'slug' => 'shopify-store-launch',
                'category' => 'web',
                'price' => 179,
                'sale_price' => null,
                'sku' => 'SHOP-LAUNCH-06',
                'image' => 'assets/img/project/11.jpg',
                'short' => 'Ready-to-sell Shopify store with theme setup and product pages.',
                'features' => ['Theme Setup', 'Product Pages', 'Payment Ready', 'Mobile Optimization'],
            ],
        ];

        $created = collect();

        foreach ($products as $index => $item) {
            $created->push(MarketplaceProduct::query()->create([
                'marketplace_category_id' => $categories[$item['category']]->id,
                'title' => $item['title'],
                'slug' => $item['slug'],
                'sku' => $item['sku'],
                'price' => $item['price'],
                'sale_price' => $item['sale_price'],
                'price_suffix' => 'One Time',
                'short_description' => $item['short'],
                'description' => '<p>'.$item['short'].' Built for Digi Crafts AI clients who want a ready-to-launch digital product with clear deliverables and fast turnaround.</p>',
                'image' => $item['image'],
                'features' => $item['features'],
                'is_featured' => $index < 2,
                'is_published' => true,
                'sort_order' => $index + 1,
                'meta_title' => $item['title'].' | Marketplace',
                'meta_description' => $item['short'],
            ]));
        }

        Page::query()->firstOrCreate(
            ['slug' => 'marketplace'],
            [
                'title' => 'Marketplace',
                'breadcrumb_title' => 'Marketplace',
                'template' => 'default',
                'is_published' => true,
                'meta_title' => 'Marketplace | Digital Products',
                'meta_description' => 'Browse ready-to-launch websites, SEO kits, CRM starters, and design packages.',
            ]
        );

        if (! MenuItem::query()->where('route_name', 'marketplace.index')->exists()) {
            MenuItem::query()->create([
                'label' => 'Marketplace',
                'route_name' => 'marketplace.index',
                'location' => 'header',
                'is_active' => true,
                'sort_order' => 80,
            ]);
        }

        return $created;
    }
}
