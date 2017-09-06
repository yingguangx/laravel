<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWheelSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wheel_settings', function (Blueprint $table) {
            $table->increments('wheel_setting_id');
            $table->integer('start_time')->comment('活动开始时间');
            $table->integer('finish_time')->comment('活动结束时间');
            $table->tinyInteger('play_num')->comment('每人每天可抽奖次数');
            $table->text('rules')->comment('活动规则');
            $table->integer('valid_time')->comment('卡券的有效时间');
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
        Schema::dropIfExists('wheel_settings');
    }
}
