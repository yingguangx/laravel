<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('users表的外鍵');
            $table->tinyInteger('play_num')->default(0)->comment('玩大转盘的总次数');
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
        Schema::dropIfExists('user_plays');
    }
}
