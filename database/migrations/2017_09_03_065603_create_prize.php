<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrize extends Migration
{
    /**
     * Run the migrations.
     *奖品表
     * @return void
     */
    public function up()
    {
        Schema::create('prize', function (Blueprint $table) {
            $table->increments('prize_id')->comment('奖品主键');
            $table->double('probability',3,0)->comment('中奖概率');
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
