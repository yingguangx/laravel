<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrizeDetail extends Migration
{
    /**
     * Run the migrations.
     *奖品详情表
     * @return void
     */
    public function up()
    {
        Schema::create('prize_detail', function (Blueprint $table) {
            $table->increments('prize_detail_id')->comment('奖品详情表主键');
            $table->integer('prize_id')->comment('prize表外键');
            $table->string('name')->comment('奖品名称');
            $table->double('deposit',5,0)->comment('充值金额单位元 0-直接送');
            $table->double('prize',5,0)->comment('赠送的游戏币单位万');
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
