<?php

namespace App\Support;

use App\Models\Page;
use Illuminate\Support\Collection;

class SystemPages
{
    /**
     * Core frontend routes that use page banners from DB.
     *
     * @return array<string, array{title: string, breadcrumb_title: string, template: string}>
     */
    public static function definitions(): array
    {
        return [
            'about' => [
                'title' => 'About Us',
                'breadcrumb_title' => 'About Us',
                'template' => 'about',
            ],
            'contact' => [
                'title' => 'Contact Us',
                'breadcrumb_title' => 'Contact Us',
                'template' => 'contact',
            ],
            'services' => [
                'title' => 'Our Services',
                'breadcrumb_title' => 'Services',
                'template' => 'default',
            ],
            'team' => [
                'title' => 'Our Team',
                'breadcrumb_title' => 'Team',
                'template' => 'default',
            ],
            'projects' => [
                'title' => 'Our Projects',
                'breadcrumb_title' => 'Projects',
                'template' => 'default',
            ],
            'blog' => [
                'title' => 'Blog',
                'breadcrumb_title' => 'Blog',
                'template' => 'default',
            ],
            'faq' => [
                'title' => 'FAQs',
                'breadcrumb_title' => 'FAQs',
                'template' => 'default',
            ],
            'quote' => [
                'title' => 'Get A Quote',
                'breadcrumb_title' => 'Get A Quote',
                'template' => 'default',
            ],
        ];
    }

    /**
     * Create missing system pages (does not overwrite existing content/banners).
     *
     * @return Collection<int, Page>
     */
    public static function ensure(): Collection
    {
        $pages = collect();

        foreach (self::definitions() as $slug => $data) {
            $page = Page::query()->firstOrCreate(
                ['slug' => $slug],
                [
                    'title' => $data['title'],
                    'breadcrumb_title' => $data['breadcrumb_title'],
                    'template' => $data['template'],
                    'is_published' => true,
                    'sort_order' => 0,
                    'meta_title' => $data['title'],
                ]
            );

            $pages->push($page);
        }

        return $pages;
    }
}
