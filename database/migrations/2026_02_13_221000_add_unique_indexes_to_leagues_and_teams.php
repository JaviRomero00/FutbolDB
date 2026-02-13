<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leagues', function (Blueprint $table) {
            $table->unique('name', 'leagues_name_unique');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->unique(['name', 'league_id'], 'teams_name_league_unique');
        });
    }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropUnique('teams_name_league_unique');
        });

        Schema::table('leagues', function (Blueprint $table) {
            $table->dropUnique('leagues_name_unique');
        });
    }
};
