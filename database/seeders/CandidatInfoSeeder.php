<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                "commune"=>"Bruxelles",
                'date_naissance' => Carbon::createFromDate('1994', '8', '31'),
                "pc"=>1,
                "statut"=>"Demandeur d'emploi",
                "parcours" => "Bac +2",
                "phone"=>484567877,
                "motivation" => "Test Test",
                "objectif" => "Emploi",
            ],
            [
                "candidat_id"=>2,
                "adresse" => "Rue de Paris 66",
                "commune"=>"Bruxelles",
                "phone"=>484567877,
                'date_naissance' => Carbon::createFromDate('1993', '9', '27'),
                "pc"=>1,
                "statut"=>"Etudiant",
                "parcours" => "Bac +2",
                "motivation" => "Test Test",
                "objectif" => "Emploi",
            ],
            [
                "candidat_id"=>3,
                "adresse" => "Rue de Bruxelles 66",
                "commune"=>"Bruxelles",
                "statut"=>"Demandeur d'emploi",
                'date_naissance' => Carbon::createFromDate('1996', '5', '7'),
                "parcours" => "CESS",
                "phone"=>484567877,
                "pc"=>1,
                "motivation" => "Test Test",
                "objectif" => "Emploi",
            ],
        ]);
    }
}
