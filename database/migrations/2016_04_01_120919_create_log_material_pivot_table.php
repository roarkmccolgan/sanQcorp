<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogMaterialPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_material', function (Blueprint $table) {
            $table->integer('log_id')->unsigned()->index();
            $table->foreign('log_id')->references('id')->on('log')->onDelete('cascade');
            $table->integer('material_id')->unsigned()->index();
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
        Schema::drop('log_material');
    }
}
