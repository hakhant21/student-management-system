<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculation_details', function (Blueprint $table) {
            $table->id();
            $table->string('roll_number')->unique();
            $table->unsignedBigInteger('examination_department_id');
            $table->foreign('examination_department_id')
                    ->references('id')
                    ->on('examination_departments')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('study_id');
            $table->foreign('study_id')
                    ->references('id')
                    ->on('studies')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('entrance_application_id')->unique();
            $table->foreign('entrance_application_id')
                    ->references('id')
                    ->on('entrance_applications')
                    ->onDelete('cascade');

            $table->string('year', 4);
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
        Schema::dropIfExists('matriculation_details');
    }
}
