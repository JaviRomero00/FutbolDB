<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('footer_settings')) {
            return;
        }

        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('FutbolDB');
            $table->string('owner_name')->default('Javi');
            $table->string('contact_email')->nullable();
            $table->string('contact_location')->nullable();

            $table->text('about_text')->nullable();
            $table->text('legal_notice')->nullable();
            $table->text('privacy_notice')->nullable();
            $table->text('cookies_notice')->nullable();

            $table->string('legal_url')->nullable();
            $table->string('privacy_url')->nullable();
            $table->string('cookies_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
