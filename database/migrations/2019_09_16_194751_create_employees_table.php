<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedInteger('skill_id')->index();
            $table->integer('day_rate');
            $table->dateTime('employed_date');
            $table->boolean('active')->default(1);
            $table->string('cell')->nullable();
            $table->string('id_num')->nullable();
            $table->string('image')->nullable();
            $table->string('nok_name')->nullable();
            $table->string('nok_number')->nullable();
            $table->integer('fp_id')->nullable();
            $table->string('card_id')->nullable();
            $table->integer('payroll')->nullable();
            $table->boolean('clocked')->default(0);
            $table->dateTime('lastscan');
            $table->timestamps();
            $table->SoftDeletes();

            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
