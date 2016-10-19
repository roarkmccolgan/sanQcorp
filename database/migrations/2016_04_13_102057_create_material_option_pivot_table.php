<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialOptionPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_option', function (Blueprint $table) {
            $table->integer('material_id')->unsigned()->index();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->integer('option_id')->unsigned()->index();
            $table->foreign('option_id')->references('id')->on('option')->onDelete('cascade');
            $table->primary(['material_id', 'option_id']);
            
            $table->integer('qty')->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->decimal('cost_price',8,2)->nullable();
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
        Schema::drop('material_option');
    }
}
