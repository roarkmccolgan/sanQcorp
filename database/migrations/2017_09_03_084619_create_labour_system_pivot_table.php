<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabourSystemPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labour_system', function (Blueprint $table) {
            $table->integer('labour_id')->unsigned()->index();
            $table->foreign('labour_id')->references('id')->on('labours')->onDelete('cascade');
            $table->integer('system_id')->unsigned()->index();
            $table->foreign('system_id')->references('id')->on('system')->onDelete('cascade');
            $table->integer('qty')->default(1);
            $table->primary(['labour_id', 'system_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('labour_system');
    }
}
