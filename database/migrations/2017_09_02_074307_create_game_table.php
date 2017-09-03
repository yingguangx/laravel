<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('game', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('游戏名称');
            $table->string('description')->comment('游戏简介');
            $table->timestamps();
            $table->integer('status')->default(1)->comment('1表示经营 2 暂停经营');
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
