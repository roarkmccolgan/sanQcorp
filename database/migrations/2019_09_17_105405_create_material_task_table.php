<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_task', function (Blueprint $table) {
            $table->unsignedInteger('material_id')->index();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->unsignedInteger('task_id')->index();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->primary(['material_id', 'task_id']);
            $table->string('area')->nullable();
            $table->integer('coverage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_task');
    }
}
