<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabourNightshiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labour_nightshift', function (Blueprint $table) {
            $table->unsignedBigInteger('labour_id')->index();
            $table->foreign('labour_id')->references('id')->on('labours')->onDelete('cascade');
            $table->unsignedBigInteger('nightshift_id')->index();
            $table->foreign('nightshift_id')->references('id')->on('nightshifts')->onDelete('cascade');
            $table->primary(['labour_id', 'nightshift_id']);
            $table->integer('qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labour_nightshift');
    }
}
