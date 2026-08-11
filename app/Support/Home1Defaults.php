<?php

namespace App\Support;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\File;

class Home1Defaults
{
    /**
     * @return array<string, mixed>
     */
    public static function content(): array
    {
        return [
            'hero_subtitle' => 'Everything You Need to Create a Website',
            'hero_title' => 'Business Innovation With IT Services expertise',
            'hero_cta_text' => 'get Started',
            'hero_cta_url' => '/quote',
            'hero_image' => self::copyAsset('assets/img/hero/heroThumb1_1.png', 'home', 'heroThumb1_1.png'),
            'hero_checklist' => [
                'Deployment and Support',
                'Discovery and Analysis',
                'Flexibility and Adaptability',
                'Competitive Advantage',
            ],
            'trustpilot_label' => 'Trustipilot',
            'trustpilot_reviews' => '450+ reviews',
            'google_label' => 'Google',
            'google_reviews' => '450+ reviews',

            'services_subtitle' => 'Our Services',
            'services_title' => 'Elevating Businesses with IT Ingenuity',

            'about_subtitle' => 'about company',
            'about_title' => 'Navigating Tech Horizons Together',
            'about_text' => "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you",
            'about_image' => self::copyAsset('assets/img/about/aboutThumb1_1.png', 'home', 'aboutThumb1_1.png'),
            'about_image_2' => self::copyAsset('assets/img/about/aboutThumb1_2.png', 'home', 'aboutThumb1_2.png'),
            'about_feature_1' => 'Back-End Development',
            'about_feature_2' => 'Product Design',
            'about_stat_1_number' => '20.5',
            'about_stat_1_suffix' => 'k',
            'about_stat_1_label' => 'Projects Done',
            'about_stat_2_number' => '100.5',
            'about_stat_2_suffix' => 'k',
            'about_stat_2_label' => 'Happy Clients',
            'about_stat_3_number' => '150.5',
            'about_stat_3_suffix' => 'k',
            'about_stat_3_label' => 'Team Members',
            'about_cta_url' => '/contact',

            'projects_subtitle' => 'Examples of our work',
            'projects_title' => 'Check Our Latest Portfolios',
            'projects_detail_title' => 'Detailing of our Project',
            'projects_detail_text' => 'There are many variations passages of Lorem Ipsum available but the majority have suffered alteration in some form by injected humour,',
            'projects_feature_1' => 'Responsive website',
            'projects_feature_2' => '100% Customers Satisfaction',
            'projects_feature_3' => 'Big Data & Analytics',
            'projects_image' => self::copyAsset('assets/img/project/projectThumb1_1.png', 'home', 'projectThumb1_1.png'),
            'projects_image_2' => self::copyAsset('assets/img/project/projectThumb1_2.png', 'home', 'projectThumb1_2.png'),
            'project_categories' => [
                ['title' => 'Data Analysis', 'icon' => 'assets/img/icon/projectItemIcon1_1.svg'],
                ['title' => 'UI/UX Designing', 'icon' => 'assets/img/icon/projectItemIcon1_2.svg'],
                ['title' => 'App Development', 'icon' => 'assets/img/icon/projectItemIcon1_3.svg'],
                ['title' => 'Wp Development', 'icon' => 'assets/img/icon/projectItemIcon1_4.svg'],
                ['title' => '3D Design Solution', 'icon' => 'assets/img/icon/projectItemIcon1_5.svg'],
            ],

            'video_url' => 'https://www.youtube.com/watch?v=f2Gzr8sAGB8',
            'video_image' => 'assets/img/video/videoThumb1_1.png',

            'process_steps' => [
                ['number' => '01', 'title' => 'Requirement', 'text' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.'],
                ['number' => '02', 'title' => 'UI/UX Desing', 'text' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.'],
                ['number' => '03', 'title' => 'Prototype', 'text' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.'],
                ['number' => '04', 'title' => 'Development', 'text' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.'],
            ],

            'pricing_subtitle' => 'Our Pricing',
            'pricing_title' => 'Our Awesome Pricing Plans',

            'team_subtitle' => 'Our Expert',
            'team_title' => 'See Our Skilled Expert Team',

            'faq_subtitle' => 'Faq',
            'faq_title' => 'Prioritize Your Site’s Safety and Security',
            'faq_image' => self::copyAsset('assets/img/faq/faqThumb1_1.png', 'home', 'faqThumb1_1.png'),
            'faq_image_2' => self::copyAsset('assets/img/faq/faqThumb1_2.png', 'home', 'faqThumb1_2.png'),

            'cta_subtitle' => 'Contact US',
            'cta_title' => '24/7 Expert Hosting Support Our Customers Love',
            'cta_button_text' => 'Talk to a Specialist',
            'cta_button_url' => '/contact',
            'cta_image' => self::copyAsset('assets/img/cta/ctaThumb1_1.png', 'home', 'ctaThumb1_1.png'),

            'testimonial_subtitle' => 'Testimonials',
            'testimonial_title' => 'Our Latest Client Feedback',
            'testimonials' => [
                [
                    'text' => 'Extech has completely transformed our process. The user-friendly interface and powerful features maintaining our website. Highly recommended for all!',
                    'name' => 'Kristin Watson',
                    'role' => 'Web Designer',
                    'image' => 'assets/img/testimonial/testiThumb3_1.png',
                ],
                [
                    'text' => "I've been using Extech for several months now, and I'm extremely impressed with the ease of customization it offers. The wide range of templates.",
                    'name' => 'Theresa Webb',
                    'role' => 'Tech enthusiast',
                    'image' => 'assets/img/testimonial/testiThumb3_2.png',
                ],
                [
                    'text' => 'Extech offers exceptional value for money. The comprehensive suite of tools and seamless integration with various plugins and services make it a for all',
                    'name' => 'Ronald Richards',
                    'role' => 'Web Enterprenuor',
                    'image' => 'assets/img/testimonial/testiThumb3_3.png',
                ],
            ],

            'blog_subtitle' => 'Blog & News',
            'blog_title' => 'Featured News And Insights',

            'cta2_title' => 'Stay Connected With Cutting Edge IT',
            'cta2_button_text' => 'Talk to a Specialist',
            'cta2_button_url' => '/contact',
            'cta2_image' => 'assets/img/cta/ctaThumb.png',
        ];
    }

    public static function copyAsset(string $publicRelativePath, string $directory, string $fileName): string
    {
        $source = public_path($publicRelativePath);
        $targetDir = storage_path('app/public/'.$directory);

        if (! File::isDirectory($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $destination = $targetDir.DIRECTORY_SEPARATOR.$fileName;

        if (File::isFile($source)) {
            File::copy($source, $destination);
        }

        return $directory.'/'.$fileName;
    }

    /**
     * @return array<string, mixed>
     */
    public static function apply(bool $switchTemplate = true): array
    {
        $settings = SiteSetting::query()->first() ?? SiteSetting::current();
        $settings->home_1_content = self::content();

        if ($switchTemplate) {
            $settings->home_template = 'home-1';
        }

        $settings->save();
        SiteSetting::flushCache();

        return $settings->home_1_content ?? [];
    }
}
