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
