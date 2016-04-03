<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsJobsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts_jobs', function (Blueprint $table) {
            $table->integer('contacts_id')->unsigned()->index();
            $table->foreign('contacts_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->integer('jobs_id')->unsigned()->index();
            $table->foreign('jobs_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->primary(['contacts_id', 'jobs_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contacts_jobs');
    }
}
