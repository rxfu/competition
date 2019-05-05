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
            $table->unsignedBigInteger('marker_id')->comment('评委ID');
            $table->unsignedBigInteger('player_id')->comment('选手ID');
            $table->decimal('design_score', 5, 2)->nullable()->comment('教学设计得分');
            $table->decimal('live_score', 5, 2)->nullable()->comment('教学环节得分');
            $table->decimal('reflection_score', 5, 2)->nullable()->comment('教学反思得分');
            $table->boolean('design_confirmed')->default(false)->comment('教学设计得分是否确认，0-未确认，1-已确认');
            $table->timestamps();

            $table->foreign('marker_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('player_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->index(['year', 'marker_id', 'player_id']);
            $table->unique(['year', 'marker_id', 'player_id']);
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
