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
                "role_id"=>1,
                "genre_id"=>1,
                "email" => "jeandujardin@gmail.com",
                "password" => Hash::make("password"),
                "created_at" => now(),
            ],
            [
                "nom" => "Dupont",
                "prenom" => "Juliette",
                "role_id"=>1,
                "genre_id"=>1,
                "email" => "juliette@gmail.com",
                "password" => Hash::make("password"),
                "created_at" => now(),
            ],
        ]);
    }
}
