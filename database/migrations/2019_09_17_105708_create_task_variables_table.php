<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_variables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tasks_id');
            $table->string('name')->index();
            $table->string('label');
            $table->integer('rate');

            $table->foreign('tasks_id')->references('id')->on('tasks');
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
        Schema::dropIfExists('task_variables');
    }
}
