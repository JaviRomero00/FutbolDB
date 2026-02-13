<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('footer_settings')) {
            return;
        }

        Schema::table('footer_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('footer_settings', 'site_name')) {
                $table->string('site_name')->default('FutbolDB');
            }
            if (!Schema::hasColumn('footer_settings', 'owner_name')) {
                $table->string('owner_name')->default('Javi');
            }
            if (!Schema::hasColumn('footer_settings', 'contact_email')) {
                $table->string('contact_email')->nullable();
            }
            if (!Schema::hasColumn('footer_settings', 'contact_location')) {
                $table->string('contact_location')->nullable();
            }

            if (!Schema::hasColumn('footer_settings', 'about_text')) {
                $table->text('about_text')->nullable();
            }
            if (!Schema::hasColumn('footer_settings', 'legal_notice')) {
                $table->text('legal_notice')->nullable();
            }
            if (!Schema::hasColumn('footer_settings', 'privacy_notice')) {
                $table->text('privacy_notice')->nullable();
            }
            if (!Schema::hasColumn('footer_settings', 'cookies_notice')) {
                $table->text('cookies_notice')->nullable();
            }

            if (!Schema::hasColumn('footer_settings', 'legal_url')) {
                $table->string('legal_url')->nullable();
            }
            if (!Schema::hasColumn('footer_settings', 'privacy_url')) {
                $table->string('privacy_url')->nullable();
            }
            if (!Schema::hasColumn('footer_settings', 'cookies_url')) {
                $table->string('cookies_url')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('footer_settings')) {
            return;
        }

        Schema::table('footer_settings', function (Blueprint $table) {
            foreach ([
                'site_name',
                'owner_name',
                'contact_email',
                'contact_location',
                'about_text',
                'legal_notice',
                'privacy_notice',
                'cookies_notice',
                'legal_url',
                'privacy_url',
                'cookies_url',
            ] as $col) {
                if (Schema::hasColumn('footer_settings', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
