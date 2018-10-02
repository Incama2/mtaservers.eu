<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineplayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlineplayers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serverID');
            $table->integer('count');
            $table->dateTime('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->index('serverID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onlineplayers');
    }
}
