<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sexes')->insert([
            [
                "nom"           =>  "femme",
                "created_at"    =>  now(),
            ],
            [
                "nom"           =>  "homme",
                "created_at"    =>  now(),
            ],
            [
                "nom"           =>  "autres",
                "created_at"    =>  now(),
            ],
        ]);
    }
}
