<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPayCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pay_code', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('userID');
            $table->string('imgUrl')->comment('图片链接地址');
            $table->integer('type')->comment('图片类型');
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
        Schema::dropIfExists('user_pay_code');
    }
}
