<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->unsignedBigInteger('image_type_id');
            $table->foreign('image_type_id')
                    ->references('id')
                    ->on('image_types')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('entrance_application_id');
            $table->foreign('entrance_application_id')
                    ->references('id')
                    ->on('entrance_applications')
                    ->onDelete('cascade');

            $table->unique(['image_type_id', 'entrance_application_id']);

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
        Schema::dropIfExists('images');
    }
}
