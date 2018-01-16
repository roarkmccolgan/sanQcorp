<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGuaranteeIdToSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system', function ($table) {
            $table->integer('guarantee_id')->nullable()->unsigned();

            $table->foreign('guarantee_id')->references('id')->on('guarantees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system', function ($table) {
            $table->dropForeign('system_guarantee_id_foreign');
        });
    }
}
