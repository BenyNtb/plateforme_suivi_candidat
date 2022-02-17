<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            [
                "nom"           =>  "Femme",
                "created_at"    =>  now(),
            ],
            [
                "nom"           =>  "Homme",
                "created_at"    =>  now(),
            ],
            [
                "nom"           =>  "Autre",
                "created_at"    =>  now(),
            ],
        ]);

    }
}
