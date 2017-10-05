<?php

namespace App\Services\Impl;

use App\Models\Etablissement;
use App\Services\EtablissementService;
use Datatables;

class EtablissementServiceImpl implements EtablissementService
{
    /**
     * pour les dataTables
     */
    public function allEtablissementDatatable()
    {


        $etablissements = Etablissement::select([
            'id', 'nom', 'prenom', 'date_naissance', 'genre', 'promotion'
        ]);

        return Datatables::of($etablissements)
            ->addColumn('action', function ($etablissement) {
                $action = '<a data-id="' . $etablissement->id . '" class="btn btn-xs btn-primary "><i class="glyphicon glyphicon-edit"></i> Editer</a>';
                $action .= '&nbsp;<a data-id="' . $etablissement->id . '" class="btn btn-xs btn-danger btn-primary delete"><i class="glyphicon glyphicon-remove"></i>sup</a>';
                return $action;
            })
            ->addColumn('profil', function ($etablissement) {
                $profil = '<a href="{{' . route('PROFIL-ETUDIANT-VIEW', $etablissement->id) . '}}" role="button" class="btn btn-xs btn-primary " ><i class="zmdi zmdi-account"></i>profil</a>';

                return $profil;
            })
            ->rawColumns(['profil', 'action'])
            ->smart(true)
            ->make(true);
    }

    public function updateEtablissement($request, $id)
    {
        // TODO: Implement updateEtablissement() method.
    }

    public function createEtablissement($request)
    {
        Etablissement::create($request->all());
    }

    public function findEtablissement($id)
    {
        // TODO: Implement findEtablissement() method.
    }

    public function deleteEtablissement($id)
    {
        $etablissement = Etablissement::find($id);

        return $etablissement->delete();
    }

    /**
     * @return int
     */

    public function countEtablissement()
    {
        return Etablissement::count();
    }
}