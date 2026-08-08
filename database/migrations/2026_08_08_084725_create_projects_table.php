<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

require_once __DIR__.'/helpers/seo_columns.php';

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client')->nullable();
            $table->string('category')->nullable();
            $table->date('project_date')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('banner_image')->nullable();
            $table->json('gallery')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            add_seo_columns($table);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
