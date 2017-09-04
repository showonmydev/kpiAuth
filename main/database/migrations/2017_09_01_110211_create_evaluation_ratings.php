<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationRatings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comment_id')->comment = "This refers to evaluation comments table";
            $table->integer('point_id')->comment = "This refers to evaluation points table";
            $table->integer('point_value')->comment = "calculate by value from settings table";
            $table->integer('acheived_value')->comment = "value given by senior";
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluation_ratings');
    }
}
