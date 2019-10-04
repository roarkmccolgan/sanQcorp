<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_job', function (Blueprint $table) {
            $table->unsignedInteger('contact_id')->index();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->unsignedInteger('job_id')->index();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->primary(['contact_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_job');
    }
}
