<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('players', function (Blueprint $table) {
        $table->index('league_id');
        $table->index('team_id');
        // Opcional si vas a buscar por nombre:
        // $table->index('name');
    });
}

public function down(): void
{
    Schema::table('players', function (Blueprint $table) {
        $table->dropIndex(['league_id']);
        $table->dropIndex(['team_id']);
        // $table->dropIndex(['name']);
    });
}

};
