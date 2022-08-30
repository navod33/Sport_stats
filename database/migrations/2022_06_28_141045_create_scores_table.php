<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->unsignedBigInteger('game_id')->nullable()->references('id')->on('games');
            $table->unsignedBigInteger('team_id')->nullable()->references('id')->on('teams');

            $table->string('time_segment');
            $table->string('position');
            $table->unsignedBigInteger('player_id')->nullable()->references('id')->on('players');
            $table->integer('score')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
