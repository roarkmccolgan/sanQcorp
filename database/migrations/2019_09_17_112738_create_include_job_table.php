<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncludeJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('include_job', function (Blueprint $table) {
            $table->unsignedInteger('include_id')->index();
            $table->foreign('include_id')->references('id')->on('includes')->onDelete('cascade');
            $table->unsignedInteger('job_id')->index();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->primary(['include_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('include_job');
    }
}
