<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nickName')->nullable();
            $table->string('password');
            $table->string('key')->default('');
            $table->string('email')->unique();
	          $table->string('mobile')->nullable();
            $table->string('headImgUrl')->nullable();
	          $table->string('district')->nullable();
	          $table->string('city')->nullable();
	          $table->unsignedInteger('money')->default('0');
	          $table->unsignedInteger('points')->default('0');
	          $table->tinyInteger('status')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
