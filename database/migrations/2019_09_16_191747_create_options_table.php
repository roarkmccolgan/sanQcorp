<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('accepted_at')->nullable();
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('system_id');
            $table->dateTime('completed_at')->nullable();

            $table->integer('total_labour');
            $table->integer('total_supervisor');
            $table->integer('days');
            $table->integer('total_materials');
            $table->integer('total_cost_price');
            $table->integer('total_selling_price');
            $table->integer('markup')->default(100);

            //parameters
            // $table->integer('area')->nullable();
            // $table->integer('perimeter')->nullable();
            // $table->integer('difficulty')->nullable();
            // $table->string('pitch')->nullable();
            // $table->string('volume')->nullable();
            // $table->decimal('length',10,2)->nullable();
            // $table->decimal('height',10,2)->nullable();
            // $table->decimal('width',10,2)->nullable();
            // $table->decimal('ridge',10,2)->nullable();
            // $table->decimal('sidewall',10,2)->nullable();
            // $table->decimal('valleys',10,2)->nullable();
            // $table->decimal('crosslaps',10,2)->nullable();
            // $table->decimal('crack',10,2)->nullable();
            // $table->decimal('plug',10,2)->nullable();
            // $table->decimal('honeycomb',10,2)->nullable();
            // $table->decimal('tieholes',10,2)->nullable();

            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
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
        Schema::dropIfExists('options');
    }
}
