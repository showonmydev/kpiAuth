<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_comments', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('user_id');
             $table->integer('project_id');
             $table->integer('responsible_id');
             $table->integer('month');
             $table->integer('year');
             $table->longText('comments');
             $table->integer('settings_id')->comment = "This refers to point value settings";
             $table->enum('type', ['log', 'final']);
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
        Schema::dropIfExists('evaluation_comments');
    }
}
