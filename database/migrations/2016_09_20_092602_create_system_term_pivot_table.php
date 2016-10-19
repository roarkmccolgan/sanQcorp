<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTermPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_term', function (Blueprint $table) {
            $table->integer('system_id')->unsigned()->index();
            $table->foreign('system_id')->references('id')->on('system')->onDelete('cascade');
            $table->integer('term_id')->unsigned()->index();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->primary(['system_id', 'term_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('system_term');
    }
}
