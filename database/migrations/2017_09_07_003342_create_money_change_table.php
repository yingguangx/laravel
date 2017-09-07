<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneyChangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_change', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('users表的id');
            $table->integer('game_id')->comment('game表id');
            $table->integer('play_time')->comment('玩大转盘的时间');
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
        //
    }
}
