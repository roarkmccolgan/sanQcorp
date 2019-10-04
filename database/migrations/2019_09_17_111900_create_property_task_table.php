<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_task', function (Blueprint $table) {
            $table->unsignedInteger('property_id')->index();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->unsignedInteger('task_id')->index();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->primary(['property_id', 'task_id']);

            //extra column
            $table->string('conversion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_task');
    }
}
