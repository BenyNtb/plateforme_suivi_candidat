<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etudiants')->insert([
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
