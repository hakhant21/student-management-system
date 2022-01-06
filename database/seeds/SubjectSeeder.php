<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            [
                'name' => ['မြန်မာ', 'အင်္ဂလိပ်', 'သင်္ချာ', 'ဓာတု', 'ရူပ', 'ဘောဂ']
            ],
            [
                'name' => ['မြန်မာ', 'အင်္ဂလိပ်', 'သင်္ချာ', 'ဓာတု', 'ရူပ', 'ဇီဝ']
            ],
            [
                'name' => ['မြန်မာ', 'အင်္ဂလိပ်', 'သင်္ချာ', 'ဓာတု', 'ရူပ', 'ဘောဂ', 'စိတ်ပညာ'],
            ],
            [
                'name' => ['မြန်မာ', 'အင်္ဂလိပ်', 'သင်္ချာ', 'ဓာတု', 'ရူပ', 'ဇီဝ', 'စိတ်ပညာ']
            ]
        ];

        foreach($subjects as $subject)
        {

        }

        DB::table('subjects')->insert($subject);
    }
}
