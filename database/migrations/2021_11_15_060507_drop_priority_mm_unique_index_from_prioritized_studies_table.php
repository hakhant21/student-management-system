<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPriorityMmUniqueIndexFromPrioritizedStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prioritized_studies', function (Blueprint $table) {
            $table->dropIndex('prioritized_studies_priority_mm_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prioritized_studies', function (Blueprint $table) {
            //
        });
    }
}
