<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->unsignedBigInteger('owner_id')->nullable()->references('id')->on('users');
            $table->unsignedBigInteger('season_id')->nullable()->references('id')->on('seasons');
            $table->unsignedBigInteger('team_a_id')->nullable()->references('id')->on('teams');

            $table->unsignedBigInteger('team_b_id')->nullable()->references('id')->on('teams');
            $table->string('team_b_name')->nullable();

            $table->text('tournament_name')->nullable();
            $table->dateTime('played_at')->nullable();
            $table->text('location')->nullable();

            // scores
            // quarter
            // player_id
            // position
            // score

            $table->string('team_a_image_uuid')->nullable()->references('uuid')->on('files');
            $table->string('team_b_image_uuid')->nullable()->references('uuid')->on('files');

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
        Schema::dropIfExists('games');
    }
}
