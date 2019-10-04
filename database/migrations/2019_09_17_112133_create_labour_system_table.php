<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabourSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labour_system', function (Blueprint $table) {
            $table->unsignedBigInteger('labour_id')->index();
            $table->foreign('labour_id')->references('id')->on('labours')->onDelete('cascade');
            $table->unsignedBigInteger('system_id')->index();
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
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
        Schema::dropIfExists('labour_system');
    }
}
