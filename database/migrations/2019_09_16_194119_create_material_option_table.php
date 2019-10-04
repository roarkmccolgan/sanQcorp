<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_option', function (Blueprint $table) {
            $table->unsignedInteger('material_id')->index();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->unsignedInteger('option_id')->index();
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->primary(['material_id', 'option_id']);
            
            $table->integer('qty')->nullable();
            $table->integer('price')->nullable();
            $table->integer('cost_price')->nullable();
            $table->string('product_type')->nullable();
            $table->string('task')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_option');
    }
}
