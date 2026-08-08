<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Extech');
            $table->string('tagline')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_white')->nullable();
            $table->string('favicon')->nullable();
            $table->string('preloader_text')->default('EXTECH');

            // Home template: home-1 | home-2 | home-3
            $table->string('home_template')->default('home-1');

            // Color scheme
            $table->string('color_theme')->default('#384BFF');
            $table->string('color_theme2')->default('#18185E');
            $table->string('color_theme3')->default('#F98600');
            $table->string('color_header')->default('#0F0D1D');
            $table->string('color_text')->default('#585858');
            $table->string('color_title')->default('#0F0D1D');
            $table->string('color_bg')->default('#F3F7FB');
            $table->string('color_body')->default('#ffffff');
            $table->string('color_border')->default('#E3E3E3');

            // Fonts (Google Font family names)
            $table->string('font_title')->default('Rajdhani');
            $table->string('font_body')->default('Plus Jakarta Sans');

            // Contact
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('map_embed_url')->nullable();

            // Social
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();

            // Header / Footer
            $table->string('header_cta_text')->default('Get A Quote');
            $table->string('header_cta_url')->nullable();
            $table->text('offcanvas_text')->nullable();
            $table->text('footer_about')->nullable();
            $table->string('footer_copyright')->nullable();

            // Home section content (per template)
            $table->json('home_1_content')->nullable();
            $table->json('home_2_content')->nullable();
            $table->json('home_3_content')->nullable();

            // Global / homepage SEO defaults
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_type')->nullable()->default('website');
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->string('twitter_card')->nullable()->default('summary_large_image');
            $table->string('canonical_url')->nullable();
            $table->string('robots')->nullable()->default('index, follow');
            $table->longText('schema_markup')->nullable();
            $table->longText('custom_head_code')->nullable();
            $table->longText('custom_body_code')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
