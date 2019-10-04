<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('stock',10,2)->default(0);
            $table->integer('pack_size');
            $table->integer('cost_price');
            $table->integer('day_rate')->nullable();
            $table->string('unit_of_measure');
            $table->string('product_type');
            $table->decimal('coverage',10,6);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
