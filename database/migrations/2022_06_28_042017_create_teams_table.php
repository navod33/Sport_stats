<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->unsignedBigInteger('owner_id')->nullable()->references('id')->on('users');
            $table->string('image_uuid')->nullable()->references('uuid')->on('files');
            $table->integer('player_count')->nullable();
            $table->text('name');
            $table->string('team_number')->nullable();

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
        Schema::dropIfExists('teams');
    }
}
