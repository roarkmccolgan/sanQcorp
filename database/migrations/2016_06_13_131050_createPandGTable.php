<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePandGTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pandg', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('pandg_category_id')->unsigned();
            $table->integer('jobs_id')->unsigned();
            $table->longText('description')->nullable();
            $table->decimal('rate',15,2);
            $table->integer('qty')->unsigned();
            $table->enum('period', ['fixed', 'daily', 'weekly', 'monthly']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('jobs_id')->references('id')->on('jobs');
            $table->foreign('pandg_category_id')->references('id')->on('pandg_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pandg');
    }
}
