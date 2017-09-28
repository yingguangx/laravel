<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoneyToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('messages',function($table){
            $table->string('money')->nullable()->comment('人民币');
            $table->string('order_time')->nullable()->comment('订单时间');
            $table->integer('type')->nullable()->comment('1为上下分，2为余额兑换');
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
