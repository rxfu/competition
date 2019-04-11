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
            $table->unsignedBigInteger('user_id')->comment('选手ID');
            $table->string('year', 4)->comment('年度');
            $table->string('syllabus', 128)->nullable()->comment('教学大纲');
            $table->string('design', 128)->nullable()->comment('教学设计');
            $table->string('section', 128)->nullable()->comment('教学节段');
            $table->string('catalog', 128)->nullable()->comment('教学目录');
            $table->unsignedInteger('seq')->nullable()->comment('抽签号');
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
