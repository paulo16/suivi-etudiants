<?php

namespace App\Services\Impl;

use App\Models\Evolution;
use App\Services\EvolutionService;
use Yajra\DataTables\Facades\DataTables;

class EvolutionServiceImpl implements EvolutionService
{
    /**
     * pour les dataTables
     */
    public function datatable()
    {
        $evolutions = Evolution::join('villes', 'evolutions.ville_id', '=', 'villes.id')
            ->join('filieres', 'evolutions.filiere_id', '=', 'filieres.id')
            ->join('etablissements', 'evolutions.etablissement_id', '=', 'etablissements.id')
            ->join('etudiants', 'evolutions.etudiant_id', '=', 'etudiants.id')
            ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.prenom as prenom',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre',
                'etudiants.promotion as promotion', 'villes.nom as ville', 'villes.id as ville_id',
                'filieres.nom as filiere',
                'etablissements.nom as ecole', 'evolutions.situation as situation')
            ->whereColumn('etudiants.promotion', 'evolutions.annee')
        ;

        return DataTables::eloquent($evolutions)
            ->addColumn('nom', 'admin.evolution.nom')
            ->addColumn('prenom', 'admin.evolution.prenom')
            ->rawColumns(['nom', 'prenom'])
            ->addColumn('action', 'admin.evolution.action')
            ->smart(true)
            ->make(true);
    }
}
