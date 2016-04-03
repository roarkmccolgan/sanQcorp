<?php

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
            $table->increments('id');

            $table->string('order_number')->unique();
            $table->string('name');
            $table->decimal('value', 15, 2)->nullable();
            $table->integer('distance');

            $table->boolean('accepted')->default(0);
            $table->string('status');
            $table->timestamp('start_date')->nullable;
            $table->timestamp('end_date')->nullable;

            $table->string('estate')->nullable();
            $table->string('estate_address')->nullable();
            $table->string('estate_suburb')->nullable();

            $table->string('address');
            $table->string('suburb')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
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
        Schema::drop('jobs');
    }
}
