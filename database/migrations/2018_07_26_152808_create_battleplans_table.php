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
            $table->text('description')->nullable();
            $table->boolean("saved")->default(false);

            $table->unsignedInteger('owner')
              ->nullable();
              $table->foreign('owner')
                ->references('id')
                ->on('users');

            $table->unsignedInteger('gametype_id')
              ->nullable();
              $table->foreign('gametype_id')
                ->references('id')
                ->onDelete('set null')
                ->on('gametypes');

            $table->unsignedInteger('map_id')
              ->nullable();
              $table->foreign('map_id')
                ->references('id')
                ->onDelete('set null')
                ->on('maps');

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
