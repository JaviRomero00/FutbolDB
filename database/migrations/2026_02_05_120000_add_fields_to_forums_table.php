<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('forums', function (Blueprint $table) {
            $table->string('topic')->after('id');
            $table->text('content')->after('topic');
            $table->boolean('is_active')->default(true)->after('content');
            $table->foreignId('user_id')->after('is_active')->constrained()->cascadeOnDelete();

            $table->index('topic');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('forums', function (Blueprint $table) {
            $table->dropIndex(['topic']);
            $table->dropIndex(['is_active']);
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn(['topic', 'content', 'is_active']);
        });
    }
};
