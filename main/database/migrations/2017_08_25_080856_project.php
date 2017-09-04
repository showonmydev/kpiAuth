<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Project extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('project', function (Blueprint $table) {
        $table->increments('id');
        $table->string('project_name');
        $table->string('client_name');
        $table->integer('user_id');
        $table->integer('project_manager');
        $table->integer('responsible');
        $table->string('accountable');
        $table->enum('status', ['open','hold','closed']);
        $table->longText('client_final_comment');
        $table->integer('business_analyst')->comment = "List of users whose role is business analysis";
        $table->date('created_at')->default(date("Y-m-d H:i:s"));
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('project');
    }
}
