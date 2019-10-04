<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_material', function (Blueprint $table) {
            $table->unsignedBigInteger('log_id')->index();
            $table->foreign('log_id')->references('id')->on('logs')->onDelete('cascade');
            $table->unsignedBigInteger('material_id')->index();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->primary(['log_id', 'material_id']);
            $table->decimal('quantity',5,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_material');
    }
}
