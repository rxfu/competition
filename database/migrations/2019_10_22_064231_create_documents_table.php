<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year', 4)->comment('年度');
            $table->unsignedBigInteger('user_id')->comment('选手ID');
            $table->string('syllabus', 128)->nullable()->comment('教学大纲');
            $table->string('design', 128)->nullable()->comment('教学设计');
            $table->string('section', 128)->nullable()->comment('教学节段');
            $table->string('catalog', 128)->nullable()->comment('教学目录');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
