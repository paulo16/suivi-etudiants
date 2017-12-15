<?php

namespace App\Services\Impl;

use App\Models\Etudiant;
use App\Models\Evolution;
use App\Services\EvolutionService;
use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;
use Yajra\DataTables\Facades\DataTables;

class EvolutionServiceImpl implements EvolutionService
{
    /**
     * pour les dataTables
     */
    public function datatable()
    {
        $evolutions = Etudiant::leftjoin('evolutions', 'evolutions.etudiant_id', '=', 'etudiants.id')
        ->join('villes', 'evolutions.ville_id', '=', 'villes.id')
        ->join('filieres', 'evolutions.filiere_id', '=', 'filieres.id')
        ->join('etablissements', 'evolutions.etablissement_id', '=', 'etablissements.id')
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

    public function evolutions($id)
    {

        return Evolution::join('villes', 'evolutions.ville_id', '=', 'villes.id')
        ->join('filieres', 'evolutions.filiere_id', '=', 'filieres.id')
        ->join('etablissements', 'evolutions.etablissement_id', '=', 'etablissements.id')
        ->select('evolutions.annee as annee', 'villes.nom as ville', 'filieres.nom as filiere', 'etablissements.nom as ecole', 'evolutions.situation as situation','evolutions.id as id_evolution')
        ->where('evolutions.id', '=', $id)
        ->first();

    }

    public function update(Request $request, $id)
    {
        $evolution = Evolution::where('id', $request->get('id_evolution'))->first();
        $etudiant = Etudiant::where('id', $evolution->etudiant_id);
        if($etudiant){
            $etudiant->update(['promotion'=>$request->get('annee')]);
        }

        $updatesEvolutions = [
            'annee'         => $request->get('annee'),
            'situation'         => $request->get('situation'),
            'ville_id'         => $request->get('ville'),
            'filiere_id'       => $request->get('filiere'),
            'etablissement_id' => $request->get('etablissement'),
        ];
        $evolution->update($updatesEvolutions);
        return  $evolution ;
    }

    public function store(Request $request){

        return Evolution::create([
            'etudiant_id'       => $request->get('id_etudiant'),
            'annee'         => $request->get('annee'),
            'situation'         => $request->get('situation'),
            'ville_id'         => $request->get('ville'),
            'filiere_id'       => $request->get('filiere'),
            'etablissement_id' => $request->get('etablissement'),
        ]);
    }

}
