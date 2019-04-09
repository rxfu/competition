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
            $table->bigIncrements('id');
            $table->string('username', 50)->unique()->comment('用户名');
            $table->string('password', 255)->comment('密码');
            $table->string('name', 20)->comment('姓名');
            $table->unsignedInteger('gender_id')->comment('性别ID');
            $table->unsignedInteger('education_id')->comment('学历ID');
            $table->unsignedInteger('degree_id')->comment('学位ID');
            $table->unsignedInteger('department_id')->comment('院校ID');
            $table->unsignedInteger('subject_id')->comment('学科ID');
            $table->string('direction', 50)->nullable()->comment('研究方向');
            $table->string('phone', 20)->comment('联系电话');
            $table->string('address')->nullable()->comment('通讯地址');
            $table->string('leader', 20)->nullable()->comment('学校联系人');
            $table->string('leader_phone', 20)->nullable()->comment('学校联系人联系电话');
            $table->string('email')->unique()->nullable()->comment('电子邮箱');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('portrait', 128)->nullable()->comment('照片');
            $table->boolean('is_enable')->default(true)->comment('是否启用，0-禁用，1-启用');
            $table->boolean('is_super')->default(false)->comment('是否超级管理员，0-否，1-是');
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
