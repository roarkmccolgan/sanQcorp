<?php

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
            $table->increments('id');
            $table->string('name');
            $table->integer('category_id')->unsigned()->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('stock',10,2)->default(0);
            $table->integer('pack_size');
            $table->decimal('cost_price',8,2);
            $table->decimal('day_rate',8,2)->nullable();
            $table->string('unit_of_measure');
            $table->string('product_type');
            $table->decimal('coverage',6,2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('materials');
    }
}
