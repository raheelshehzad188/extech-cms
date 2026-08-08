<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@extech.test'],
            ['name' => 'Admin', 'password' => Hash::make('password')]
        );

        SiteSetting::query()->updateOrCreate(['id' => 1], [
            'site_name' => 'Extech',
            'tagline' => 'IT Solution & Technology Company',
            'preloader_text' => 'EXTECH',
            'home_template' => 'home-1',
            'color_theme' => '#384BFF',
            'color_theme2' => '#18185E',
            'color_theme3' => '#F98600',
            'color_header' => '#0F0D1D',
            'color_text' => '#585858',
            'color_title' => '#0F0D1D',
            'color_bg' => '#F3F7FB',
            'color_body' => '#ffffff',
            'color_border' => '#E3E3E3',
            'font_title' => 'Rajdhani',
            'font_body' => 'Plus Jakarta Sans',
            'email' => 'info@example.com',
            'phone' => '+11002345909',
            'address' => 'Main Street, Melbourne, Australia',
            'working_hours' => 'Mon-Friday, 09am - 05pm',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'linkedin' => 'https://linkedin.com',
            'youtube' => 'https://youtube.com',
            'header_cta_text' => 'Get A Quote',
            'header_cta_url' => '/contact',
            'offcanvas_text' => 'We deliver innovative IT solutions for modern businesses.',
            'footer_about' => 'Extech is a technology company providing IT services, digital transformation and software solutions.',
            'footer_copyright' => '© '.date('Y').' Extech. All Rights Reserved.',
            'meta_title' => 'Extech - IT Solution & Technology',
            'meta_description' => 'Extech provides IT solutions, software development, cloud services and digital transformation.',
            'meta_keywords' => 'IT solutions, technology, software, cloud, digital agency',
            'meta_author' => 'Extech',
            'og_title' => 'Extech - IT Solution & Technology',
            'og_description' => 'Business innovation with IT services expertise.',
            'robots' => 'index, follow',
            'home_1_content' => [
                'hero_subtitle' => 'Everything You Need to Create a Website',
                'hero_title' => 'Business Innovation With IT Services Expertise',
                'hero_cta_text' => 'Get Started',
                'hero_cta_url' => '/contact',
                'hero_checklist' => [
                    'Deployment and Support',
                    'Discovery and Analysis',
                    'Flexibility and Adaptability',
                    'Competitive Advantage',
                ],
                'about_subtitle' => 'About Company',
                'about_title' => 'We Make Your Business Smarter With Digital Solutions',
                'about_text' => 'We help organizations modernize operations with reliable technology partnerships.',
                'services_subtitle' => 'Our Services',
                'services_title' => 'We Provide Best IT Solutions For Your Business',
                'cta_title' => 'Ready to transform your business?',
                'cta_text' => 'Let our experts build the right technology roadmap for you.',
                'cta_button_text' => 'Contact Us',
                'cta_button_url' => '/contact',
            ],
            'home_2_content' => [
                'hero_subtitle' => 'Modern IT Partner',
                'hero_title' => 'Smart IT Solutions For Your Growing Business',
                'hero_cta_text' => 'Get A Quote',
                'about_text' => 'Scale faster with cloud, software and managed IT services.',
                'services_title' => 'What We Offer',
            ],
            'home_3_content' => [
                'hero_subtitle' => 'Extech Agency',
                'hero_title' => 'Technology That Powers Digital Transformation',
                'hero_cta_text' => 'Start a Project',
                'about_text' => 'Build, scale and innovate with a trusted IT partner.',
            ],
        ]);

        $menu = [
            ['label' => 'Home', 'url' => '/', 'sort_order' => 1],
            ['label' => 'About', 'url' => '/about', 'sort_order' => 2],
            ['label' => 'Services', 'url' => '/services', 'sort_order' => 3],
            ['label' => 'Team', 'url' => '/team', 'sort_order' => 4],
            ['label' => 'Projects', 'url' => '/projects', 'sort_order' => 5],
            ['label' => 'Blog', 'url' => '/blog', 'sort_order' => 6],
            ['label' => 'Contact', 'url' => '/contact', 'sort_order' => 7],
        ];
        foreach ($menu as $item) {
            MenuItem::query()->updateOrCreate(
                ['label' => $item['label'], 'location' => 'header', 'parent_id' => null],
                $item + ['is_active' => true]
            );
        }

        Page::query()->updateOrCreate(['slug' => 'about'], [
            'title' => 'About Us',
            'subtitle' => 'Who we are',
            'content' => '<p>Extech is a leading IT solutions company helping businesses innovate with technology.</p>',
            'is_published' => true,
            'meta_title' => 'About Extech | IT Solution Company',
            'meta_description' => 'Learn about Extech, our mission, team and technology expertise.',
            'meta_keywords' => 'about extech, IT company, technology partner',
        ]);

        Page::query()->updateOrCreate(['slug' => 'contact'], [
            'title' => 'Contact Us',
            'content' => '<p>Have a project in mind? Reach out and our team will respond shortly.</p>',
            'is_published' => true,
            'meta_title' => 'Contact Extech',
            'meta_description' => 'Contact Extech for IT consulting, development and support.',
            'meta_keywords' => 'contact extech, IT support, get quote',
        ]);

        $services = [
            ['title' => 'Web Development', 'icon' => 'fa-solid fa-code', 'short_description' => 'Custom websites and web applications.', 'meta_keywords' => 'web development, laravel, websites'],
            ['title' => 'Cloud Services', 'icon' => 'fa-solid fa-cloud', 'short_description' => 'Secure scalable cloud infrastructure.', 'meta_keywords' => 'cloud, aws, hosting'],
            ['title' => 'UI/UX Design', 'icon' => 'fa-solid fa-pen-ruler', 'short_description' => 'Beautiful user-centered product design.', 'meta_keywords' => 'ui ux, design, product'],
            ['title' => 'Cyber Security', 'icon' => 'fa-solid fa-shield-halved', 'short_description' => 'Protect your digital assets.', 'meta_keywords' => 'security, cybersecurity'],
            ['title' => 'Digital Marketing', 'icon' => 'fa-solid fa-bullhorn', 'short_description' => 'Grow traffic and conversions.', 'meta_keywords' => 'seo, marketing, growth'],
            ['title' => 'IT Consulting', 'icon' => 'fa-solid fa-handshake', 'short_description' => 'Strategy and technology advisory.', 'meta_keywords' => 'consulting, IT strategy'],
        ];

        foreach ($services as $i => $service) {
            Service::query()->updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($service['title'])],
                [
                    'title' => $service['title'],
                    'icon' => $service['icon'],
                    'short_description' => $service['short_description'],
                    'description' => '<p>'.$service['short_description'].' Our experts deliver end-to-end implementation and support.</p>',
                    'features' => ['Discovery', 'Implementation', 'Support'],
                    'is_featured' => $i < 3,
                    'is_published' => true,
                    'sort_order' => $i + 1,
                    'meta_title' => $service['title'].' | Extech',
                    'meta_description' => $service['short_description'],
                    'meta_keywords' => $service['meta_keywords'],
                    'og_title' => $service['title'],
                    'og_description' => $service['short_description'],
                    'robots' => 'index, follow',
                ]
            );
        }

        $team = [
            ['name' => 'Masirul Islam', 'designation' => 'Web Designer'],
            ['name' => 'Jessica Pearson', 'designation' => 'Project Manager'],
            ['name' => 'John Abraham', 'designation' => 'Software Engineer'],
            ['name' => 'Alex Mika', 'designation' => 'UI/UX Designer'],
        ];
        foreach ($team as $i => $member) {
            TeamMember::query()->updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($member['name'])],
                [
                    'name' => $member['name'],
                    'designation' => $member['designation'],
                    'bio' => $member['name'].' is a dedicated professional at Extech.',
                    'is_published' => true,
                    'sort_order' => $i + 1,
                    'meta_title' => $member['name'].' | Extech Team',
                    'meta_description' => $member['name'].' - '.$member['designation'].' at Extech',
                    'meta_keywords' => $member['name'].', '.$member['designation'].', extech team',
                    'robots' => 'index, follow',
                ]
            );
        }

        Project::query()->updateOrCreate(['slug' => 'business-analytics'], [
            'title' => 'Business Analytics',
            'client' => 'Extech Client',
            'category' => 'Technology',
            'short_description' => 'Analytics platform for business insights.',
            'description' => '<p>A complete analytics solution for modern enterprises.</p>',
            'is_published' => true,
            'sort_order' => 1,
            'meta_title' => 'Business Analytics Project | Extech',
            'meta_description' => 'Case study: Business Analytics platform by Extech.',
            'meta_keywords' => 'analytics, project, case study',
        ]);

        Post::query()->updateOrCreate(['slug' => 'future-of-it-services'], [
            'title' => 'The Future of IT Services',
            'category' => 'Technology',
            'author_name' => 'Admin',
            'excerpt' => 'How cloud and AI are reshaping IT delivery.',
            'content' => '<p>IT services are evolving rapidly with AI, automation and cloud-native platforms.</p>',
            'published_at' => now(),
            'is_published' => true,
            'meta_title' => 'The Future of IT Services | Extech Blog',
            'meta_description' => 'Insights on cloud, AI and modern IT service delivery.',
            'meta_keywords' => 'IT services, cloud, AI, blog',
        ]);

        Faq::query()->updateOrCreate(['question' => 'What services do you offer?'], [
            'answer' => 'We offer web development, cloud, cybersecurity, UI/UX, marketing and IT consulting.',
            'is_published' => true,
            'sort_order' => 1,
            'meta_keywords' => 'services, faq',
        ]);

        Faq::query()->updateOrCreate(['question' => 'How can I get a quote?'], [
            'answer' => 'Use the contact form or call us directly and our team will respond quickly.',
            'is_published' => true,
            'sort_order' => 2,
            'meta_keywords' => 'quote, contact, faq',
        ]);
    }
}
