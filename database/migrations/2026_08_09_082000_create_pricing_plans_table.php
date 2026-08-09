<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('monthly_price')->nullable();
            $table->string('yearly_price')->nullable();
            $table->string('monthly_suffix')->default('/ Month');
            $table->string('yearly_suffix')->default('/ Year');
            $table->string('icon')->nullable();
            $table->json('features')->nullable();
            $table->string('button_text')->default('Get Started Now');
            $table->string('button_url')->nullable();
            $table->string('card_style')->default('style1');
            $table->boolean('is_highlighted')->default(false);
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pricing_plans');
    }
};
