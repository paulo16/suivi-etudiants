<?php
/**
 * Created by PhpStorm.
 * User: PAUL
 * Date: 2017-09-16
 * Time: 19:49
 */

namespace App\Services\Impl;

use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\DB;
use App\Models\Etudiant;
use App\Services\AccueilService;

class AccueilServiceImpl implements AccueilService
{


    public function statsParAnnees()
    {
        $promotions = DB::table('evolutions')
            ->select('annee')
            ->distinct()
            ->orderBy('annee', 'asc')
            ->get()
            ->toArray();

        $labels = [];
        foreach ($promotions as $key => $val) {

            $labels[] = $val->annee != 0 ? $val->annee : 'Années Absentes';

        }

        Debugbar::info($labels);


        $etudiants = DB::table('evolutions')
            ->select(DB::raw('count(*) as nbetudiants, annee'))
            ->groupBy('annee')
            ->orderBy('annee', 'asc')
            ->get()
            ->toArray();

        $dataetudiants = [];
        foreach ($etudiants as $key => $val) {
            $dataetudiants[] = $val->nbetudiants;

        }
        Debugbar::info($dataetudiants);


        $villes = DB::table('evolutions')
            ->join('villes', 'evolutions.ville_id', '=', 'villes.id')
            ->select(DB::raw('count(DISTINCT villes.nom) as nbvilles,evolutions.annee'))
            ->groupBy(['evolutions.annee'])
            ->orderBy('evolutions.annee', 'asc')
            ->get()
            ->toArray();

        $datavilles = [];
        foreach ($villes as $key => $val) {
            $datavilles[] = $val->nbvilles;

        }
        Debugbar::info($datavilles);


        $etablissements = DB::table('evolutions')
            ->join('etablissements', 'evolutions.etablissement_id', '=', 'etablissements.id')
            ->select(DB::raw('count(DISTINCT etablissements.nom) as nbetablissements ,evolutions.annee'))
            ->groupBy(['evolutions.annee'])
            ->orderBy('evolutions.annee', 'asc')
            ->get()
            ->toArray();

        $dataetablissements = [];
        foreach ($etablissements as $key => $val) {
            $dataetablissements [] = $val->nbetablissements;

        }
        Debugbar::info($dataetablissements);

        $filieres = DB::table('evolutions')
            ->join('filieres', 'evolutions.filiere_id', '=', 'filieres.id')
            ->select(DB::raw('count( DISTINCT filieres.nom) as nbfilieres ,evolutions.annee'))
            ->groupBy(['evolutions.annee'])
            ->orderBy('evolutions.annee', 'asc')
            ->get()
            ->toArray();

        $datafilieres = [];
        foreach ($filieres as $key => $val) {
            $datafilieres [] = $val->nbfilieres;

        }
        Debugbar::info($datafilieres);

        $options = [
            'scales' => [
                'yAxes' =>
                    [
                        'stacked' => true,
                        'ticks' => ['beginAtZero' => true]
                    ],
            ]
        ];

        $chartjs = app()->chartjs
            ->name('StatsParAnnee')
            ->type('bar')
            ->size(['width' => 300, 'height' => 100])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "les étudiants",
                    'backgroundColor' => 'rgba(88, 100, 100, 0.5)',
                    'data' => $dataetudiants
                ],
                [
                    "label" => "les villes",
                    'backgroundColor' => 'rgba(255, 0, 132, 0.5)',
                    'data' => $datavilles
                ],
                [
                    "label" => "les etablissements",
                    'backgroundColor' => 'rgba(40, 190, 132, 0.5)',
                    'data' => $dataetablissements
                ],
                [
                    "label" => "les filières",
                    'backgroundColor' => 'rgba(0, 99, 255, 0.5)',
                    'data' => $datafilieres
                ],
            ])
            ->optionsRaw($options);


        return $chartjs;
    }


    public function statsParVilles()
    {
        // TODO: Implement statsParVilles() method.
    }
}