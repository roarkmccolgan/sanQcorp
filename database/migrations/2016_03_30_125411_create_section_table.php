<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobs_id')->unsigned();            
            $table->boolean('accepted')->default(0);          
            $table->string('name');
            $table->longText('survey')->nullable();
            $table->boolean('complete')->default(0);
            $table->binary('properties')->nullable();

            $table->timestamps();

            $table->foreign('jobs_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('section');
    }
}
