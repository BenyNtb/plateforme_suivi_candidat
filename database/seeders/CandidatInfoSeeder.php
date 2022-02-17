<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidatInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('candidat_infos')->insert([
            [
                "candidat_id"=>1,
                "adresse" => "Rue de Paris 66",
                "parcours" => "Bac +2",
                "motivation" => "Test Test",
                "objectif" => "Emploi",
                "connaissance" => "Connaissance basique HTML et CSS",
            ],
            [
                "candidat_id"=>2,
                "adresse" => "Rue de Paris 66",
                "parcours" => "Bac +2",
                "motivation" => "Test Test",
                "objectif" => "Emploi",
                "connaissance" => "Connaissance basique HTML et CSS",
            ],
            [
                "candidat_id"=>3,
                "adresse" => "Rue de Bruxelles 66",
                "parcours" => "CESS",
                "motivation" => "Test Test",
                "objectif" => "Emploi",
                "connaissance" => "pas de connaissance",
            ],
        ]);
    }
}
