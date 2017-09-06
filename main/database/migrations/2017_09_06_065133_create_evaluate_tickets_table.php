<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluateTicketsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('evaluate_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('settings_id')->comment = "This refers to point value settings";
            $table->integer('users_id');
            $table->integer('revision_id')->comment = "user id of those who are Project Manager and Responsible";
            $table->integer('project_id')->nullable();
            $table->integer('months');
            $table->integer('year');
            $table->enum('status', ['enable', 'disable']);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('evaluate_tickets');
    }
}