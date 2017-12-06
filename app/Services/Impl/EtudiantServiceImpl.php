<?php

namespace App\Services\Impl;

use App\Models\Etudiant;
use App\Services\EtudiantService;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class EtudiantServiceImpl implements EtudiantService
{
    /**
     * pour les dataTables
     */
    public function datatable()
    {
        $etudiants = Etudiant::query()->select('id', 'nom', 'prenom', 'date_naissance', 'genre', 'promotion');

        return DataTables::eloquent($etudiants)
            ->addColumn('action', 'admin.etudiant.action')
            ->smart(true)
            ->make(true);
    }

    public function update(Request $request, $id)
    {
        $etudiant = Etudiant::where('id', $id)->update($request->all());
        return $etudiant;
    }

    public function create(Request $request)
    {
        return Etudiant::create([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'email' => $request->get('email'),
            'tel' => $request->get('tel'),
            'date_naissance' => $request->get('date_naissance'),
            'status' => $request->get('status'),
            'promotion' => $request->get('promotion'),
            'genre' => $request->get('genre'),
            'adresse' => $request->get('adresse'),
        ]);
    }

    public function find($id)
    {
        $etudiant = Etudiant::find($id);

        return $etudiant;
    }

    public function delete($id)
    {
        $etudiant = Etudiant::find($id);

        return $etudiant->delete();
    }

    /**
     * @return int
     */

    public function countEtudiant()
    {
        return Etudiant::count();
    }

     public function infoEtudiant($id)
    {
        return Etudiant::leftjoin('evolutions', 'evolutions.etudiant_id', '=', 'etudiants.id')
            ->join('villes', 'evolutions.ville_id', '=', 'villes.id')
            ->join('filieres', 'evolutions.filiere_id', '=', 'filieres.id')
            ->join('etablissements', 'evolutions.etablissement_id', '=', 'etablissements.id')
            ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.prenom as prenom',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre', 'evolutions.annee as annee', 'villes.nom as ville', 'filieres.nom as filiere', 'etablissements.nom as ecole',
                'evolutions.situation as situation ')
            ->where('evolutions.annee', '=', 'etudiants.promotion')
            ->where('evolutions.etudiant_id', '=', $id)
            ->first();
    }


}