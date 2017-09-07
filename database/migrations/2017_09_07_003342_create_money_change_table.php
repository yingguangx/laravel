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
            $table->string('name', 100)->comment('微信名称');
            $table->integer('money')->comment('兑换金额');
            $table->string('payeesort', 100)->comment('收款类型');
            $table->string('payeeaccount', 100)->comment('收款账号');
            $table->string('payeename', 100)->comment('收款人姓名');
            $table->string('payeecode', 100)->comment('收款人二维码');
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
