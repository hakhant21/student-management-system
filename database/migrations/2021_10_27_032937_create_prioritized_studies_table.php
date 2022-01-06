<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrioritizedStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prioritized_studies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matriculation_detail_id');
            $table->foreign('matriculation_detail_id')
                    ->references('id')
                    ->on('matriculation_details')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('study_id');
            $table->foreign('study_id')
                    ->references('id')->on('studies')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->unsignedTinyInteger('priority');
            $table->string('priority_mm', 10)->unique();

            $table->unique(['matriculation_detail_id', 'study_id']);
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
        Schema::dropIfExists('prioritized_studies');
    }
}
