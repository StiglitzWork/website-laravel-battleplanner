<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBattleplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battleplans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('mode');
            $table->unsignedInteger('owner')
              ->nullable();
              $table->foreign('owner')
                ->references('id')
                ->on('users');
            $table->unsignedInteger('room_id')
              ->nullable();
              $table->foreign('room_id')
                ->references('id')
                ->on('rooms');
            $table->unsignedInteger('gametype_id')
              ->nullable();
              $table->foreign('gametype_id')
                ->references('id')
                ->on('gametypes');
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
        Schema::dropIfExists('battleplans');
    }
}
