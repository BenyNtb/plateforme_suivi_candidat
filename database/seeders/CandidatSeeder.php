<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('candidats')->insert([
            [
                "nom" => "Dujardin",
                "prenom" => "Jean",
                "email" => "jeandujardin@gmail.com",
                "password" => Hash::make("testtest"),
                "created_at" => now(),
            ],
        ]);
    }
}
