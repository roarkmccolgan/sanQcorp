<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionTaskPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_task', function (Blueprint $table) {
            $table->integer('option_id')->unsigned()->index();
            $table->foreign('option_id')->references('id')->on('option')->onDelete('cascade');
            $table->integer('task_id')->unsigned()->index();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->primary(['option_id', 'task_id']);

            $table->decimal('total',5,2)->default(0);
            $table->decimal('done',5,2)->default(0);
            $table->boolean('complete')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('option_task');
    }
}
