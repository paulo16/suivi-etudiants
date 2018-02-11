<?php

namespace App\Services\Impl;

use App\Models\Etablissement;
use App\Services\EtablissementService;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Jenssegers\Date\Date;

class EtablissementServiceImpl implements EtablissementService {

    public function listetablissements(Request $request) {
        $columns = array(
            0 => 'id',
            1 => 'nom',
            2 => 'adresse',
            3 => 'site',
            4 => 'tel',
            5 => 'action',
        );

        $totalData = Etablissement::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {

            $etablissements = Etablissement::select('etablissements.id as id', 'etablissements.nom as nom',
                'etablissements.adresse as adresse', 'etablissements.url_site as site', 'etablissements.tel as tel')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        } else {
            $search = $request->input('search.value');

            $etablissements = Etablissement::select('etablissements.id as id', 'etablissements.nom as nom',
                'etablissements.adresse as adresse', 'etablissements.url_site as site', 'etablissements.tel as tel')
            ->where('etablissements.nom', 'LIKE', "%{$search}%")
            ->orwhere('etablissements.adresse', 'LIKE', "%{$search}%")
            ->orwhere('etablissements.url_site', 'LIKE', "%{$search}%")
            ->orWhere('etablissements.tel', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

            $totalFiltered = Etablissement::select('etablissements.id as id', 'etablissements.nom as nom','etablissements.adresse as adresse', 'etablissements.url_site as site', 'etablissements.tel as tel')
            ->where('etablissements.nom', 'LIKE', "%{$search}%")
            ->orwhere('etablissements.adresse', 'LIKE', "%{$search}%")
            ->orwhere('etablissements.url_site', 'LIKE', "%{$search}%")
            ->orWhere('etablissements.tel', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->count();
        }

        $data = array();
        if (!empty($etablissements)) {

            $url='<a href=":url" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Editer</a>';
            $delete='<a data-id=":id" class="btn btn-xs btn-danger btn-primary delete"><i class="glyphicon glyphicon-remove"></i>sup</a>';
            foreach ($etablissements as $etablissement) {
                $edit = route('etablissements.edit', $etablissement->id);
                $del =str_replace(":id",$etablissement->id,$delete); 

                $nestedData['nom'] = $etablissement->nom ;
                $nestedData['adresse'] = $etablissement->adresse;
                $nestedData['site'] = $etablissement->site;
                $nestedData['tel'] = $etablissement->tel;
                $nestedData['action'] =str_replace(":url",$edit,$url).'&nbsp;'.$del; 

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return $json_data;
    }

    public function update(Request $request, $id) {

        //Debugbar::info($request);
        $etablissement= Etablissement::find($id);
        $etablissement->nom= $request->get('nom') ? $request->get('nom') : '';
        $etablissement->adresse= $request->get('adresse') ? $request->get('adresse') : '';
        $etablissement->url_site= $request->get('site') ? $request->get('site') : '';
        $etablissement->tel= $request->get('tel') ? $request->get('tel') : ''; 

        return $etablissement->save();
    }

    public function store(Request $request) {
        $etablissement= new Etablissement();
        $etablissement->nom= $request->get('nom') ? $request->get('nom') : '';
        $etablissement->adresse= $request->get('adresse') ? $request->get('adresse') : '';
        $etablissement->url_site= $request->get('site') ? $request->get('site') : '';
        $etablissement->tel= $request->get('tel') ? $request->get('tel') : ''; 

        return $etablissement->save();
    }

    public function find($id) {
        $etablissement = Etablissement::find($id);

        return $etablissement;
    }

    public function delete($id) {
        $nbreRelation=Etablissement::leftJoin('evolutions',
            'evolutions.etablissement_id', '=',
            'etablissements.id')
        ->where('etablissement_id',$id)
        ->count();
        
        Debugbar::info($nbreRelation);

        if($nbreRelation!=0){
            return false;

        } else{
            $etablissement = Etablissement::find($id);

            return $etablissement->delete();

        }
    }

    /**
     * @return int
     */

    public function count() {
        return Etablissement::count();
    }

    public function list()
    {
        return $etablissements = Etablissement::select()
        ->orderBy('nom', 'asc')
        ->get()
        ->toArray();
    }


}
