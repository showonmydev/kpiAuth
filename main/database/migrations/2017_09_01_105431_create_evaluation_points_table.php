<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('settings_id')->comment = "This refers to point value settings";
            $table->longText('text');
            $table->string('suggestion');
            $table->enum('status',['enable','disable']);
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
        Schema::dropIfExists('evaluation_points');
    }
}
