<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsExpiredToEntranceApplicationSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrance_application_submissions', function (Blueprint $table) {
            $table->boolean('is_expired')->default(0)->after('acted_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrance_application_submissions', function (Blueprint $table) {
            //
        });
    }
}
