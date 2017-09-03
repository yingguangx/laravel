<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('staff_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->comment('账号');
            $table->string('password')->comment('密码');
            $table->integer('role')->comment('角色 1表示超级管理员 2管理员');
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
