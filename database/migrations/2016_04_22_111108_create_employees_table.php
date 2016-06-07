<?php

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
            $table->increments('id');
            $table->string('name');
            $table->integer('skill_id')->unsigned()->index();
            $table->decimal('day_rate',5,2);
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

            $table->foreign('skill_id')->references('id')->on('skill')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
    }
}