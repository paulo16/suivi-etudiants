<?php

namespace App\Services\Impl;

use App\Models\Filiere;
use App\Services\FiliereService;
use Datatables;

class FiliereServiceImpl implements FiliereService
{
    /**
     * pour les dataTables
     */
    public function allFiliereDatatable()
    {


        $filieres = Filiere::select([
            'id', 'nom', 'prenom', 'date_naissance', 'genre', 'promotion'
        ]);

        return Datatables::of($filieres)
            ->addColumn('action', function ($filiere) {
                $action = '<a data-id="' . $filiere->id . '" class="btn btn-xs btn-primary "><i class="glyphicon glyphicon-edit"></i> Editer</a>';
                $action .= '&nbsp;<a data-id="' . $filiere->id . '" class="btn btn-xs btn-danger btn-primary delete"><i class="glyphicon glyphicon-remove"></i>sup</a>';
                return $action;
            })
            ->addColumn('profil', function ($filiere) {
                $profil = '<a href="{{' . route('PROFIL-FILIERE-VIEW', $filiere->id) . '}}" role="button" class="btn btn-xs btn-primary " ><i class="zmdi zmdi-account"></i>profil</a>';

                return $profil;
            })
            ->rawColumns(['profil', 'action'])
            ->smart(true)
            ->make(true);
    }

    public function updateFiliere($request, $id)
    {
        // TODO: Implement updateFiliere() method.
    }

    public function createFiliere($request)
    {
        Filiere::create($request->all());
    }

    public function findFiliere($id)
    {
        // TODO: Implement findFiliere() method.
    }

    public function deleteFiliere($id)
    {
        $filiere = Filiere::find($id);

        return $filiere->delete();
    }

    /**
     * @return int
     */

    public function countFiliere()
    {
        return Filiere::count();
    }
}