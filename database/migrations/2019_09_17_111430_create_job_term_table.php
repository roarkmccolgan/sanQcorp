<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_term', function (Blueprint $table) {
            $table->unsignedInteger('job_id')->index();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->unsignedInteger('term_id')->index();
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
        Schema::dropIfExists('job_term');
    }
}
