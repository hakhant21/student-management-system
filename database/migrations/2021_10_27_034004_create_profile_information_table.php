<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_information', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->string('name_mm', 30);
            $table->string('name_en', 30);
            $table->string('name_title_mm', 4);
            $table->string('name_title_en', 4);
            $table->string('nrc_mm', 14)->unique();
            $table->string('nrc_en', 18)->unique();
            $table->boolean('father_death_status')->default(false);
            $table->boolean('mother_death_status')->default(false);
            $table->string('father_nrc_mm', 14);
            $table->string('father_nrc_en', 18);
            $table->string('mother_nrc_mm', 14);
            $table->string('mother_nrc_en', 18);
            $table->string('race', 20);
            $table->string('father_race', 20);
            $table->string('mother_race', 20);
            $table->string('religion', 20);
            $table->string('father_religion', 20);
            $table->string('mother_religion', 20);
            $table->string('date_of_birth', 10);
            $table->string('father_date_of_birth', 10);
            $table->string('mother_date_of_birth', 10);
            $table->string('job', 30);
            $table->string('father_job', 30);
            $table->string('mother_job', 30);
            $table->string('contact_phone', 15);
            $table->string('father_contact_phone', 15);
            $table->string('mother_contact_phone', 15);
            $table->string('father_email', 30);
            $table->string('mother_email', 30);
            $table->string('address', 200);
            $table->string('father_address', 200);
            $table->string('mother_address', 200);

            $table->unsignedBigInteger('entrance_application_id')->unique();
            $table->foreign('entrance_application_id')
                    ->references('id')
                    ->on('entrance_applications')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('profile_information');
    }
}
