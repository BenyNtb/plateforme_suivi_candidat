<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_candidat')->insert([
            [
                "nom"           =>  "candidat",
                "created_at"    =>  now(),
            ],
            [
                "nom"           =>  "sélectionné",
                "created_at"    =>  now(),
            ],
            [
                "nom"           =>  "etudiant",
                "created_at"    =>  now(),
            ],
        ]);
    }
}
