<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option', function (Blueprint $table) { //Change to Option??
            $table->increments('id');
            $table->boolean('accepted')->default(0);          
            $table->string('name');
            $table->integer('section_id')->unsigned();
            $table->integer('system_id')->unsigned();
            $table->decimal('rate',5,2);
            $table->integer('done')->default(0);
            $table->integer('total')->default(0);
            $table->boolean('complete')->default(0);
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('section')->onDelete('cascade');
            $table->foreign('system_id')->references('id')->on('system')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('option');
    }
}
