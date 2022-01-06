<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNrcColumnsInProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_information', function (Blueprint $table) {
            $table->string('nrc_mm', 500)->change();
            $table->string('nrc_en', 500)->change();
            $table->string('father_nrc_mm', 500)->change();
            $table->string('father_nrc_en', 500)->change();
            $table->string('mother_nrc_mm', 500)->change();
            $table->string('mother_nrc_en', 500)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_information', function (Blueprint $table) {
            //
        });
    }
}
