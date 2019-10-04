<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobPandgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_pandg', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id')->index();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->unsignedBigInteger('pandg_id')->index();
            $table->foreign('pandg_id')->references('id')->on('pandgs')->onDelete('cascade');
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
        Schema::dropIfExists('job_pandg');
    }
}
