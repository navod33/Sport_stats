<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOneScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->integer('error_record')->default(0);
            $table->integer('contract')->default(0);
            $table->integer('center_pass')->default(0);
            $table->integer('intercept')->default(0);
            $table->integer('tip')->default(0);
            $table->integer('rebound')->default(0);
            $table->integer('goal_missed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
