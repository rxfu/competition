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
            $table->string('name', 50)->nullable()->comment('姓名');
            $table->unsignedBigInteger('gender_id')->nullable()->comment('性别ID');
            $table->string('birthday')->nullable()->comment('出生日期');
            $table->unsignedInteger('idtype')->nullable()->comment('证件类型，0-身份证，1-其他证件');
            $table->string('idnumber', 18)->unique()->nullable()->comment('身份证号');
            $table->unsignedBigInteger('education_id')->nullable()->comment('学历ID');
            $table->unsignedBigInteger('degree_id')->nullable()->comment('学位ID');
            $table->unsignedBigInteger('department_id')->nullable()->comment('院校ID');
            $table->unsignedBigInteger('subject_id')->nullable()->comment('学科ID');
            $table->string('major', 50)->nullable()->comment('专业');
            $table->string('direction', 50)->nullable()->comment('研究方向');
            $table->string('title', 50)->nullable()->comment('职称');
            $table->string('position', 50)->nullable()->comment('职务');
            $table->string('phone', 20)->nullable()->comment('联系电话');
            $table->string('address')->nullable()->comment('通讯地址');
            $table->string('leader', 20)->nullable()->comment('学校联系人');
            $table->string('leader_phone', 20)->nullable()->comment('学校联系人电话');
            $table->string('email')->unique()->nullable()->comment('电子邮箱');
            $table->unsignedBigInteger('group_id')->nullable()->comment('组ID');
            $table->string('course', 100)->nullable()->comment('参赛课程名称');
            $table->string('teaching_begin_time')->nullable()->comment('开始本科教学时间');
            $table->string('teaching_total_time')->nullable()->comment('本科教学总时间');
            $table->timestamp('email_verified_at')->nullable();
            $table->text('experience')->nullable()->comment('学习工作经历');
            $table->text('teaching')->nullable()->comment('近两年主讲课程情况');
            $table->text('thesis')->nullable()->comment('发表教学论文、著作');
            $table->text('project')->nullable()->comment('主持、参与教学改革项目');
            $table->text('reward')->nullable()->comment('教学奖励');
            $table->text('achievement')->nullable()->comment('主要科研成果');
            $table->text('opinion')->nullable()->comment('所在高校意见');
            $table->string('portrait', 128)->nullable()->comment('照片');
            $table->string('recommend', 128)->nullable()->comment('推荐表');
            $table->string('summary', 128)->nullable()->comment('初赛总结表');
            $table->boolean('is_enable')->default(true)->comment('是否启用，0-禁用，1-启用');
            $table->boolean('is_super')->default(false)->comment('是否超级管理员，0-否，1-是');
            $table->unsignedBigInteger('creator_id')->nullable()->comment('创建者ID');
            $table->unsignedBigInteger('role_id')->nullable()->comment('角色ID');
            $table->boolean('is_passed')->default(false)->comment('是否审核通过，0-未审核或审核未通过，1-审核已通过');
            $table->boolean('is_confirmed')->default(false)->comment('是否已确认，0-未确认，1-已确认');
            $table->text('memo')->nullable()->comment('备注');
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
