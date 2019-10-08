<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_task', function (Blueprint $table) {
            $table->unsignedBigInteger('option_id')->index();
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->unsignedBigInteger('task_id')->index();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->primary(['option_id', 'task_id']);

            $table->integer('order');
            $table->decimal('days',5,2)->nullable();
            $table->integer('difficulty')->nullable();
            $table->integer('total_labour_price')->nullable();
            
            $table->integer('total_materials_price')->nullable();
            $table->integer('total_cost_price')->nullable();

            $table->integer('total')->default(0);
            $table->integer('done')->default(0);
            $table->boolean('complete')->default(0);
            $table->integer('variable_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_task');
    }
}
