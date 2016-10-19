<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobPandgPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_pandg', function (Blueprint $table) {
            $table->integer('job_id')->unsigned()->index();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->integer('pandg_id')->unsigned()->index();
            $table->foreign('pandg_id')->references('id')->on('pandg')->onDelete('cascade');
            $table->primary(['job_id', 'pandg_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job_pandg');
    }
}
