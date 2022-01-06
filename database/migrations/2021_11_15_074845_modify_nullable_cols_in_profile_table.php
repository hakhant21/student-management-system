<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNullableColsInProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_information', function (Blueprint $table) {
            $table->string('father_date_of_birth', 10)->nullable()->change();
            $table->string('mother_date_of_birth', 10)->nullable()->change();
            $table->string('father_job', 30)->nullable()->change();
            $table->string('mother_job', 30)->nullable()->change();
            $table->string('father_contact_phone', 15)->nullable()->change();
            $table->string('mother_contact_phone', 15)->nullable()->change();
            $table->string('father_email', 30)->nullable()->change();
            $table->string('mother_email', 30)->nullable()->change();
            $table->string('father_address', 200)->nullable()->change();
            $table->string('mother_address', 200)->nullable()->change();
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
