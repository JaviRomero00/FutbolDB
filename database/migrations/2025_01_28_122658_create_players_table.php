<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

public function up()
{
    Schema::create('players', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('age');
        $table->float('height');
        $table->string('nationality');
        $table->float('market_value');
        $table->integer('matches_played');
        $table->integer('yellow_cards');
        $table->integer('red_cards');
        $table->integer('goals');
        $table->integer('assists');
        $table->foreignId('team_id')->constrained();
        $table->foreignId('league_id')->constrained();
        $table->timestamps();
    });
}
};
