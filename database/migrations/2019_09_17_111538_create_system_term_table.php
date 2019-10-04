<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_term', function (Blueprint $table) {
            $table->unsignedInteger('system_id')->index();
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
            $table->unsignedInteger('term_id')->index();
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
        Schema::dropIfExists('system_term');
    }
}
