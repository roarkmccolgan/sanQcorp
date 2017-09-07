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
            
            $table->decimal('total_labour',15,2);
            $table->decimal('total_supervisor',15,2);
            $table->integer('days');
            $table->decimal('total_materials',15,2);
            $table->decimal('total_cost_price',15,2);
            $table->decimal('selling_price',15,2);
            $table->integer('markup')->default(100);

            //parameters
            $table->integer('area')->nullable();
            $table->integer('perimeter')->nullable();
            $table->integer('difficulty')->nullable();
            $table->string('pitch')->nullable();
            $table->string('volume')->nullable();
            $table->decimal('length',10,2)->nullable();
            $table->decimal('height',10,2)->nullable();
            $table->decimal('width',10,2)->nullable();
            $table->decimal('ridge',10,2)->nullable();
            $table->decimal('sidewall',10,2)->nullable();
            $table->decimal('valleys',10,2)->nullable();
            $table->decimal('crosslaps',10,2)->nullable();
            $table->decimal('crack',10,2)->nullable();
            $table->decimal('plug',10,2)->nullable();
            $table->decimal('honeycomb',10,2)->nullable();
            $table->decimal('tieholes',10,2)->nullable();

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
