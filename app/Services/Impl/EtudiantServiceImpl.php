<?php

namespace App\Services\Impl;

use App\Models\Etudiant;
use App\Models\Evolution;
use App\Models\Ville;
use App\Services\EtudiantService;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

        Debugbar::info($request);
        $etudiant = Etudiant::where('id', $id);

        $updatesEtudiants = [
            'nom'            => $request->get('nom') ? $request->get('nom') : '',
            'prenom'         => $request->get('prenom') ? $request->get('prenom') : '',
            'email'          => $request->get('email') ? $request->get('email') : '',
            'tel'            => $request->get('tel') ? $request->get('tel') : '',
            'date_naissance' => $request->get('date_naissance') ? $request->get('date_naissance') : '',
            'status'         => $request->get('status') ? $request->get('status') : '',
            'promotion'      => $request->get('promotion') ? $request->get('promotion') : '',
            'genre'          => $request->get('genre') ? $request->get('genre') : '',
            'adresse'        => $request->get('adresse') ? $request->get('adresse') : '',
        ];

        $evolution = Evolution::where('id', $request->get('id_evolution'));

        $updatesEvolutions = [
            'situation'=>$request->get('situation'),
            'annee'=> $request->get('promotion'),
            'ville_id'         => $request->get('ville'),
            'filiere_id'       => $request->get('filiere'),
            'etablissement_id' => $request->get('etablissement'),
        ];

        $etudiant->update($updatesEtudiants);
        $evolution->update($updatesEvolutions);

        return $this->infoEtudiant($id);
    }

    public function create(Request $request)
    {
        return Etudiant::create([
            'nom'            => $request->get('nom'),
            'prenom'         => $request->get('prenom'),
            'email'          => $request->get('email'),
            'tel'            => $request->get('tel'),
            'date_naissance' => $request->get('date_naissance'),
            'status'         => $request->get('status'),
            'promotion'      => $request->get('promotion'),
            'genre'          => $request->get('genre'),
            'adresse'        => $request->get('adresse'),
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
            'etudiants.tel as tel', 'etudiants.email as email',
            'etudiants.date_naissance as naissance', 'etudiants.genre as genre', 'evolutions.annee as promotion', 'villes.nom as ville', 'filieres.nom as filiere', 'etablissements.nom as ecole', 'evolutions.situation as situation', 'evolutions.id as id_evolution')
        ->whereColumn('evolutions.annee', '=', 'etudiants.promotion')
        ->where('evolutions.etudiant_id', '=', $id)
        ->first();
    }

    public function listetudiants(Request $request)
    {
        $columns = array(
            0  => 'id',
            1  => 'genre',
            2  => 'promotion',
            3  => 'ville',
            4  => 'filiere',
            5  => 'ecole',
            6  => 'nom',
            7  => 'prenom',
            8  => 'naissance',
            9  => 'situation',
            10 => 'email',
        );

        $totalData = Etudiant::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {

            $etudiants = Etudiant::leftjoin('evolutions', 'evolutions.etudiant_id', '=', 'etudiants.id')
            ->join('villes', 'evolutions.ville_id', '=', 'villes.id')
            ->join('filieres', 'evolutions.filiere_id', '=', 'filieres.id')
            ->join('etablissements', 'evolutions.etablissement_id', '=', 'etablissements.id')
            ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.tel as tel', 'etudiants.prenom as prenom',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre',
                'etudiants.promotion as promotion', 'villes.nom as ville', 'villes.id as ville_id',
                'filieres.nom as filiere', 'etudiants.email as email',
                'etablissements.nom as ecole', 'evolutions.situation as situation')
            ->whereColumn('etudiants.promotion', 'evolutions.annee')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        } else {
            $search = $request->input('search.value');

            $etudiants = Etudiant::leftjoin('evolutions', 'evolutions.etudiant_id', '=', 'etudiants.id')
            ->join('villes', 'evolutions.ville_id', '=', 'villes.id')
            ->join('filieres', 'evolutions.filiere_id', '=', 'filieres.id')
            ->join('etablissements', 'evolutions.etablissement_id', '=', 'etablissements.id')
            ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.tel as tel',
                'etudiants.prenom as prenom', 'etudiants.email as email',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre',
                'etudiants.promotion as promotion', 'villes.nom as ville', 'villes.id as ville_id',
                'filieres.nom as filiere',
                'etablissements.nom as ecole', 'evolutions.situation as situation')
            ->whereColumn('etudiants.promotion', 'evolutions.annee')
            ->where('etudiants.nom', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.prenom', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.date_naissance', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.genre', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.promotion', 'LIKE', "%{$search}%")
            ->orWhere('villes.nom', 'LIKE', "%{$search}%")
            ->orWhere('filieres.nom', 'LIKE', "%{$search}%")
            ->orWhere('etablissements.nom', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.tel', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.email', 'LIKE', "%{$search}%")
            ->orWhere('evolutions.situation', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

            $totalFiltered = Etudiant::leftjoin('evolutions', 'evolutions.etudiant_id', '=', 'etudiants.id')
            ->join('villes', 'evolutions.ville_id', '=', 'villes.id')
            ->join('filieres', 'evolutions.filiere_id', '=', 'filieres.id')
            ->join('etablissements', 'evolutions.etablissement_id', '=', 'etablissements.id')
            ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.tel as tel', 'etudiants.prenom as prenom', 'etudiants.email as email',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre',
                'etudiants.promotion as promotion', 'villes.nom as ville', 'villes.id as ville_id',
                'filieres.nom as filiere',
                'etablissements.nom as ecole', 'evolutions.situation as situation')
            ->whereColumn('etudiants.promotion', 'evolutions.annee')
            ->where('etudiants.nom', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.prenom', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.date_naissance', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.genre', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.promotion', 'LIKE', "%{$search}%")
            ->orWhere('villes.nom', 'LIKE', "%{$search}%")
            ->orWhere('filieres.nom', 'LIKE', "%{$search}%")
            ->orWhere('etablissements.nom', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.tel', 'LIKE', "%{$search}%")
            ->orWhere('evolutions.situation', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.email', 'LIKE', "%{$search}%")
            ->count();
        }

        $data = array();
        if (!empty($etudiants)) {
            foreach ($etudiants as $etudiant) {
                $show = route('etudiants.show', $etudiant->id);
                $edit = route('etudiants.edit', $etudiant->id);

                $nestedData['id']        = $etudiant->id;
                $nestedData['genre']     = $etudiant->genre;
                $nestedData['promotion'] = $etudiant->promotion;
                $nestedData['ville']     = $etudiant->ville;
                $nestedData['filiere']   = $etudiant->filiere;
                $nestedData['ecole']     = $etudiant->ecole;
                $nestedData['nom']       = "<a href='{$show}' title='SHOW' >" . $etudiant->nom . "</a>";
                $nestedData['prenom']    = "<a href='{$show}' title='SHOW' >" . $etudiant->prenom . "</a>";
                $nestedData['naissance'] = "<a href='{$show}' title='SHOW' >" . $etudiant->naissance . "</a>";
                $nestedData['situation'] = $etudiant->situation;
                $nestedData['tel']       = $etudiant->tel;
                $nestedData['email']     = $etudiant->email;
                /*$nestedData['options']   = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
                &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>";*/
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
        );

        return $json_data;
    }

    public function evolutionEtudiant($id)
    {

        return Evolution::leftjoin('etudiants', 'evolutions.etudiant_id', '=', 'etudiants.id')
        ->join('villes', 'evolutions.ville_id', '=', 'villes.id')
        ->join('filieres', 'evolutions.filiere_id', '=', 'filieres.id')
        ->join('etablissements', 'evolutions.etablissement_id', '=', 'etablissements.id')
        ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.prenom as prenom',
            'etudiants.tel as tel', 'etudiants.email as email',
            'etudiants.date_naissance as naissance', 'etudiants.genre as genre', 'evolutions.annee as annee', 'villes.nom as ville', 'filieres.nom as filiere', 'etablissements.nom as ecole', 'evolutions.situation as situation','evolutions.id as id_evolution')
        ->where('evolutions.etudiant_id', '=', $id)
        ->orderBy('evolutions.annee')
        ->get()
        ->toArray();

    }


    public function listevilles()
    {
        return $villes = Ville::select()
        ->orderBy('nom', 'asc')
        ->get()
        ->toArray();
    }

}
