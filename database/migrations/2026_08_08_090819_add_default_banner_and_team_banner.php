<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('default_banner')->nullable()->after('favicon');
        });

        Schema::table('team_members', function (Blueprint $table) {
            $table->string('banner_image')->nullable()->after('image');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->string('banner_image')->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('default_banner');
        });

        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn('banner_image');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn('banner_image');
        });
    }
};
