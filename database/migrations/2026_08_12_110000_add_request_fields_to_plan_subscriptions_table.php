<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plan_subscriptions', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('phone');
            $table->string('business_name')->nullable()->after('company');
            $table->string('website')->nullable()->after('business_name');
            $table->string('country')->nullable()->after('website');
            $table->text('address')->nullable()->after('country');
        });
    }

    public function down(): void
    {
        Schema::table('plan_subscriptions', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp',
                'business_name',
                'website',
                'country',
                'address',
            ]);
        });
    }
};
