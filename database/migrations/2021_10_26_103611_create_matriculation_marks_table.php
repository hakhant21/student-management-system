<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculationMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculation_marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matriculation_detail_id');
            $table->foreign('matriculation_detail_id')
                    ->references('id')
                    ->on('matriculation_details')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')
                    ->references('id')
                    ->on('subjects')
                    ->onDelete('cascade');

            $table->unique(['matriculation_detail_id', 'subject_id']);

            $table->unsignedSmallInteger('mark');
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
        Schema::dropIfExists('matriculation_marks');
    }
}
