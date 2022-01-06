<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExaminationDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studies = [
           [
            'name' => 'ဘာသာတွဲ ၁',
            'created_at' => now(),
            'updated_at' => now()
           ],
           [
            'name' => 'ဘာသာတွဲ ၂',
            'created-at' => now(),
            'updated_at' => now()
           ],
           [
            'name' => 'ဘာသာတွဲ ၃',
            'created_at' => now(),
            'updated_at' => now()
           ],
           [
            'name' => 'ဘာသာတွဲ ၄',
            'created_at' => now(),
            'updated_at' => now()
           ],
           [
            'name' => 'ဘာသာတွဲ ၅',
            'created_at' => now(),
            'updated_at' => now()
           ]
        ];

        DB::table('studies')->insert($studies);
    }
}
