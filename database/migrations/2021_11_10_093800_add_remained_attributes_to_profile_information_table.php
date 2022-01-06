<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemainedAttributesToProfileInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_information', function (Blueprint $table) {
            $table->string('father_name_mm', 30)->after('name_title_en');
            $table->string('father_name_en', 30)->after('father_name_mm');
            $table->string('father_name_title_mm', 4)->after('father_name_en');
            $table->string('father_name_title_en', 4)->after('father_name_title_mm');
            $table->string('mother_name_mm', 30)->after('father_name_title_en');
            $table->string('mother_name_en', 30)->after('mother_name_mm');
            $table->string('mother_name_title_mm', 4)->after('mother_name_en');
            $table->string('mother_name_title_en', 4)->after('mother_name_title_mm');
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
