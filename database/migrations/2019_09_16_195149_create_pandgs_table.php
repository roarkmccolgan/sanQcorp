<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePandgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pandgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('pandg_category_id');
            $table->unsignedBigInteger('job_id');
            $table->longText('description')->nullable();
            $table->integer('rate');
            $table->unsignedBigInteger('qty');
            $table->enum('period', ['fixed', 'daily', 'weekly', 'monthly']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('pandg_category_id')->references('id')->on('pandg_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pandgs');
    }
}
