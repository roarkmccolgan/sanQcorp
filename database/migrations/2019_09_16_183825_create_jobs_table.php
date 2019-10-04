<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('order_number')->unique();
            $table->string('name');
            $table->integer('value')->nullable();
            $table->integer('distance');

            $table->boolean('accepted');

            $table->string('status');
            $table->timestamp('requested_start_date')->nullable;
            $table->timestamp('start_date')->nullable;
            $table->timestamp('end_date')->nullable;

            $table->string('estate')->nullable();
            $table->string('estate_address')->nullable();
            $table->string('estate_suburb')->nullable();

            $table->string('address');
            $table->string('suburb')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('title')->nullable();
            $table->string('title1')->nullable();
            $table->string('title2')->nullable();
            $table->boolean('custom')->default(0);
            $table->integer('insightly_opportunity_id')->nullable();
            $table->string('type')->default('service');

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}