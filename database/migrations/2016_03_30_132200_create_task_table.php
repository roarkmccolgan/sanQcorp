<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('accepted')->default(0);          
            $table->string('name');
            $table->integer('system_id')->unsigned();
            $table->decimal('rate',5,2);
            $table->integer('done')->default(0);
            $table->integer('total')->default(0);
            $table->boolean('complete')->default(0);
            $table->timestamps();

            $table->foreign('system_id')->references('id')->on('system');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task');
    }
}
