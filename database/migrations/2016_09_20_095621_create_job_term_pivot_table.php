<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTermPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_term', function (Blueprint $table) {
            $table->integer('job_id')->unsigned()->index();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->integer('term_id')->unsigned()->index();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->primary(['job_id', 'term_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job_term');
    }
}
