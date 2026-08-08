<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

require_once __DIR__.'/helpers/seo_columns.php';

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->string('category')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            add_seo_columns($table);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
