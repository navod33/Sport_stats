<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->unsignedBigInteger('owner_id')->nullable()->references('id')->on('users');
            $table->unsignedBigInteger('team_id')->nullable()->references('id')->on('teams');
            $table->string('image_uuid')->nullable()->references('uuid')->on('files');
            $table->text('name');
            $table->text('email')->nullable();
            $table->longText('positions')->nullable();

            $table->longText('metadata')->nullable();
            $table->longText('performance_notes')->nullable();

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
        Schema::dropIfExists('players');
    }
}
