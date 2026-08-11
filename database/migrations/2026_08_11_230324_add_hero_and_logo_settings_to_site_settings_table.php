<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('hero_bg_color')->nullable()->after('profile_photo');
            $table->string('hero_bg_image')->nullable()->after('hero_bg_color');
            $table->unsignedSmallInteger('logo_height')->nullable()->after('hero_bg_image');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['hero_bg_color', 'hero_bg_image', 'logo_height']);
        });
    }
};
