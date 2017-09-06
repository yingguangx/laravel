<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('客户id');
            $table->integer('game_id')->comment('游戏id');
            $table->integer('type')->comment('游戏种类');
            $table->string('money')->comment('金额');
            $table->string('value')->comment('分值');
            $table->integer('order_status')->default(1)->comment('1表示新订单 2表示正在上分 3表示已完成');
            $table->integer('status')->default(1)->comment('订单状态 0表示废弃 1表示正常');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('order');
    }
}
