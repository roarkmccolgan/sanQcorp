<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScopeSystemPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scope_system', function (Blueprint $table) {
            $table->integer('scope_id')->unsigned()->index();
            $table->foreign('scope_id')->references('id')->on('scope')->onDelete('cascade');
            $table->integer('system_id')->unsigned()->index();
            $table->foreign('system_id')->references('id')->on('system')->onDelete('cascade');
            $table->primary(['scope_id', 'system_id']);
            
            $table->int('order')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scope_system');
    }
}
