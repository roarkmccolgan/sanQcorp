<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system', function (Blueprint $table) {
            $table->increments('id');         
            $table->string('name');
            $table->string('description');
            $table->string('unit');
            $table->decimal('base_rate',5,2);
            $table->string('component')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('system');
    }
}
