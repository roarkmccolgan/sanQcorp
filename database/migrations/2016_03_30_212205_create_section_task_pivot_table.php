<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionTaskPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_task', function (Blueprint $table) {
            $table->integer('section_id')->unsigned()->index();
            $table->foreign('section_id')->references('id')->on('section')->onDelete('cascade');
            $table->integer('task_id')->unsigned()->index();
            $table->foreign('task_id')->references('id')->on('task')->onDelete('cascade');
            $table->primary(['section_id', 'task_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('section_task');
    }
}
