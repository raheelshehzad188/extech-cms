<?php

use Illuminate\Database\Schema\Blueprint;

if (! function_exists('add_seo_columns')) {
    function add_seo_columns(Blueprint $table): void
    {
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
    }
}
