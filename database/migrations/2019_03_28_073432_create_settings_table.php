<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug', 50)->unique()->comment('系统简称');
            $table->string('name', 128)->comment('系统名称');
            $table->timestamp('begin_at')->nullable()->comment('起始时间');
            $table->timestamp('end_at')->nullable()->comment('结束时间');
            $table->string('year', 4)->comment('年度');
            $table->boolean('is_enable')->default(false)->comment('是否启用，0-禁用，1-启用');
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
        Schema::dropIfExists('settings');
    }
}
