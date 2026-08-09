<?php

namespace App\Support;

use App\Models\Page;
use App\Models\SiteSetting;

class ContactDefaults
{
    /**
     * @return array<string, mixed>
     */
    public static function pageAttributes(): array
    {
        return [
            'title' => 'Contact Us',
            'slug' => 'contact',
            'subtitle' => 'Contact Us',
            'breadcrumb_title' => 'Contact Us',
            'template' => 'contact',
            'is_published' => true,
            'content' => 'Nullam varius, erat quis iaculis dictum, eros urna varius eros, ut blandit felis odio in turpis. Quisque rhoncus, eros in auctor ultrices,',
            'sections' => [
                'form_title' => 'Ready to Get Started?',
                'form_text' => 'Nullam varius, erat quis iaculis dictum, eros urna varius eros, ut blandit felis odio in turpis. Quisque rhoncus, eros in auctor ultrices,',
                'phone_label' => 'Call Us 7/24',
                'email_label' => 'Make a Quote',
                'location_label' => 'Location',
                'video_url' => 'https://www.youtube.com/watch?v=Cn4G2lZ_g2I',
                'video_image' => null,
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function siteAttributes(): array
    {
        return [
            'phone' => '+208-555-0112',
            'email' => 'Infotech@gmail.com',
            'address' => '4517 Washington ave.',
            'working_hours' => 'Mod-friday, 09am -05pm',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6678.7619084840835!2d144.9618311901502!3d-37.81450084255415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642b4758afc1d%3A0x3119cc820fdfc62e!2sEnvato!5e0!3m2!1sen!2sbd!4v1641984054261!5m2!1sen!2sbd',
        ];
    }

    public static function apply(bool $overwriteSiteSettings = true): Page
    {
        $defaults = self::pageAttributes();

        $page = Page::query()->firstOrNew(['slug' => 'contact']);
        $page->fill($defaults);
        $page->save();

        if ($overwriteSiteSettings) {
            $settings = SiteSetting::query()->first() ?? SiteSetting::current();
            $settings->fill(self::siteAttributes());
            $settings->save();
            SiteSetting::flushCache();
        }

        return $page->fresh();
    }
}
