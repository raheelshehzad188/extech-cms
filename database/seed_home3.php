<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\SiteSetting;
use App\Models\Project;

$settings = SiteSetting::query()->first() ?? SiteSetting::query()->create(['site_name' => 'Extech']);

$home3 = [
    'hero_slides' => [
        [
            'image' => 'assets/img/hero/hero-2.jpg',
            'subtitle' => 'best it company',
            'title' => "Get Our Business\nThis It Solution",
            'text' => 'Consectetur adipiscing elit aenean scelerisque at augue vitae consequat quisque eget congue velit in cursus leo sed sodales est eget turpis.',
            'btn1_text' => 'Explore More',
            'btn1_url' => '/about',
            'btn2_text' => 'Contact Us',
            'btn2_url' => '/contact',
        ],
        [
            'image' => 'assets/img/hero/hero-1.jpg',
            'subtitle' => 'best it company',
            'title' => "Get Our Business\nThis It Solution",
            'text' => 'Consectetur adipiscing elit aenean scelerisque at augue vitae consequat quisque eget congue velit in cursus leo sed sodales est eget turpis.',
            'btn1_text' => 'Explore More',
            'btn1_url' => '/about',
            'btn2_text' => 'Contact Us',
            'btn2_url' => '/contact',
        ],
        [
            'image' => 'assets/img/hero/hero-3.jpg',
            'subtitle' => 'best it company',
            'title' => "Get Our Business\nThis It Solution",
            'text' => 'Consectetur adipiscing elit aenean scelerisque at augue vitae consequat quisque eget congue velit in cursus leo sed sodales est eget turpis.',
            'btn1_text' => 'Explore More',
            'btn1_url' => '/about',
            'btn2_text' => 'Contact Us',
            'btn2_url' => '/contact',
        ],
    ],
    'about_subtitle' => 'ABOUT EXTECH',
    'about_title' => 'We Can Clients with the About Solution',
    'about_text' => 'It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point.',
    'about_image' => 'assets/img/about/05.png',
    'about_video_url' => 'https://www.youtube.com/watch?v=Cn4G2lZ_g2I',
    'about_clients_count' => '6,561',
    'about_clients_label' => 'Satisfied Clients',
    'about_phone' => '+208-555-0112',
    'about_cta_text' => 'Explore More',
    'about_cta_url' => '/about',
    'about_checklist' => [
        'Branding and design Identity',
        'Web site Marketing Solutions',
        'Unlimited Download Data',
    ],
    'brand_text' => '1k + Brands Trust Us',
    'services_subtitle' => 'What We Do',
    'services_title' => 'We Solve IT Problems With Technology',
    'services_cta_text' => 'See all Services',
    'cta_title' => "Stay Connected With\nCutting Edge IT",
    'cta_phone' => '+208-555-0112',
    'process_subtitle' => 'How IT work',
    'process_title' => 'Standard Work Process',
    'process_steps' => [
        ['title' => 'Choose A Service', 'text' => 'In a free hour, when our power of choice is untrammeled and', 'icon' => 'assets/img/process/01.svg'],
        ['title' => 'Define Requirements', 'text' => 'In a free hour, when our power of choice is untrammeled and', 'icon' => 'assets/img/process/02.svg'],
        ['title' => 'Request A Meeting', 'text' => 'In a free hour, when our power of choice is untrammeled and', 'icon' => 'assets/img/process/03.svg'],
        ['title' => 'Final Solution', 'text' => 'In a free hour, when our power of choice is untrammeled and', 'icon' => 'assets/img/process/04.svg'],
    ],
    'achievement_subtitle' => 'achievement',
    'achievement_title' => 'We Are Increasing Business Success',
    'achievements' => [
        ['number' => '6,561', 'label' => 'Satisfied Clients', 'icon' => 'assets/img/achievement-icon/01.svg'],
        ['number' => '600', 'label' => 'Finished Projects', 'icon' => 'assets/img/achievement-icon/02.svg'],
        ['number' => '250', 'label' => 'Skilled Experts', 'icon' => 'assets/img/achievement-icon/03.svg'],
        ['number' => '590', 'label' => 'Media Posts', 'icon' => 'assets/img/achievement-icon/04.svg'],
    ],
    'projects_subtitle' => 'PROJECTS',
    'projects_title' => "Our Latest Incredible\nClient's Projects",
    'projects_video_url' => 'https://www.youtube.com/watch?v=Cn4G2lZ_g2I',
    'team_subtitle' => 'Team Members',
    'team_title' => 'Our Dedicated Team Members',
    'testimonial_subtitle' => 'Testimonials',
    'testimonial_title' => 'People Who Already Love Us',
    'blog_subtitle' => 'Latest Blog',
    'blog_title' => 'Checkout Our Latest News & Articles',
    'marque_items' => 'Cyber Security,IT Solution,Technology,Data Security',
];

$settings->home_template = 'home-3';
$settings->home_3_content = $home3;
$settings->preloader_loading_text = $settings->preloader_loading_text ?: 'Loading';
$settings->save();
SiteSetting::flushCache();

// Extra projects for slider if only one exists
$extra = [
    ['title' => 'Analytic Solutions', 'slug' => 'analytic-solutions', 'category' => 'Solutions'],
    ['title' => 'Design Solutions', 'slug' => 'design-solutions', 'category' => 'Technology'],
    ['title' => 'Software Development', 'slug' => 'software-development-pro', 'category' => 'Technology'],
];
foreach ($extra as $i => $p) {
    Project::query()->updateOrCreate(
        ['slug' => $p['slug']],
        [
            'title' => $p['title'],
            'category' => $p['category'],
            'short_description' => $p['title'].' case study',
            'description' => '<p>'.$p['title'].' project details.</p>',
            'is_published' => true,
            'sort_order' => $i + 2,
            'meta_title' => $p['title'].' | Extech',
            'meta_description' => $p['title'],
            'meta_keywords' => strtolower($p['title']),
        ]
    );
}

echo "Home 3 activated & seeded.\n";
echo "Template: ".SiteSetting::current()->home_template."\n";
echo "Slides: ".count(SiteSetting::current()->home_3_content['hero_slides'] ?? [])."\n";
