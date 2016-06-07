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
        Schema::create('option', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('accepted')->default(0);          
            $table->string('name');
            $table->text('description');
            $table->integer('section_id')->unsigned();
            $table->integer('system_id')->unsigned();
            $table->boolean('complete')->default(0);
            $table->timestamps();

            $table->decimal('size',5,2)->nullable();
            $table->decimal('perimeter',5,2)->nullable();
            $table->decimal('screed',5,2)->nullable();
            $table->integer('difficulty')->nullable();
            $table->string('pitch')->nullable();
            $table->decimal('length',5,2)->nullable();
            $table->decimal('height',5,2)->nullable();
            $table->decimal('width',5,2)->nullable();
            
            $table->decimal('labour_estimate',15,2);
            $table->decimal('supervisor_estimate',15,2);
            $table->decimal('days_estimate',15,2);
            $table->decimal('total_estimate',15,2);
            $table->decimal('total_selling',15,2);
            $table->integer('markup')->default(100);


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
