<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToEntranceApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrance_applications', function (Blueprint $table) {
            $table->unsignedSmallInteger('status')->default(0)->comment('0: fresh, 1: confirmed, 2: rejected')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrance_applications', function (Blueprint $table) {
            //
        });
    }
}
