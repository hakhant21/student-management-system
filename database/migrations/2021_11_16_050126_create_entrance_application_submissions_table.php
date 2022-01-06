<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntranceApplicationSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrance_application_submissions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('entrance_application_id');
            $table->foreign('entrance_application_id')
                    ->references('id')
                    ->on('entrance_applications')
                    ->onDelete('cascade');

            $table->unsignedSmallInteger('status')->default(0)->comment('0: fresh, 1: confirmed, 2: rejected');
            $table->unsignedBigInteger('acted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrance_application_submissions');
    }
}
