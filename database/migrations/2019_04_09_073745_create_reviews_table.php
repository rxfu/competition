<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year', 4)->comment('年度');
            $table->unsignedBigInteger('judge_id', 4)->comment('评委ID');
            $table->unsignedBigInteger('player_id', 4)->comment('选手ID');
            $table->decimal('design_score', 5, 2)->nullable()->comment('教学设计得分');
            $table->decimal('live_score', 5, 2)->nullable()->comment('教学环节得分');
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
        Schema::dropIfExists('reviews');
    }
}
