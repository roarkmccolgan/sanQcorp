<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskVariableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taskVariable', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tasks_id')->unsigned();
            $table->string('name')->index();
            $table->string('label');
            $table->decimal('rate',6,2);

            $table->foreign('tasks_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('taskVariable');
    }
}
