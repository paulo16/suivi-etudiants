<?php

namespace App\Services\Impl;

use App\Models\Filiere;
use App\Services\FiliereService;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Jenssegers\Date\Date;

class FiliereServiceImpl implements filiereService {

    public function listfilieres(Request $request) {
        $columns = array(
            0 => 'id',
            1 => 'nom',
            2 => 'description',
            5 => 'action',
        );

        $totalData = Filiere::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {

            $filieres = Filiere::select('filieres.id as id', 'filieres.nom as nom',
                'filieres.description as description')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        } else {
            $search = $request->input('search.value');

            $filieres = Filiere::select('filieres.id as id', 'filieres.nom as nom',
                'filieres.description as description')
            ->where('filieres.nom', 'LIKE', "%{$search}%")
            ->orwhere('filieres.description', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

            $totalFiltered = Filiere::select('filieres.id as id', 'filieres.nom as nom',
                'filieres.description as description')
            ->where('filieres.nom', 'LIKE', "%{$search}%")
            ->orwhere('filieres.description', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->count();
        }

        $data = array();
        if (!empty($filieres)) {

            $url='<a href=":url" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Editer</a>';
            $delete='<a data-id=":id" class="btn btn-xs btn-danger btn-primary delete"><i class="glyphicon glyphicon-remove"></i>sup</a>';
            foreach ($filieres as $filiere) {
                $edit = route('filieres.edit', $filiere->id);
                $del =str_replace(":id",$filiere->id,$delete); 

                $nestedData['nom'] = $filiere->nom ;
                $nestedData['description'] = $filiere->description;
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
        $filiere= Filiere::find($id);
        $filiere->nom= $request->get('nom') ? $request->get('nom') : '';
        $filiere->description= $request->get('description') ? $request->get('description') : '';

        return $filiere->save();
    }

    public function store(Request $request) {
        $filiere= new Filiere();
        $filiere->nom= $request->get('nom') ? $request->get('nom') : '';
        $filiere->description= $request->get('description') ? $request->get('description') : '';

        return $filiere->save();
    }

    public function find($id) {
        $filiere = Filiere::find($id);

        return $filiere;
    }

    public function delete($id) {
        $nbreRelation=Filiere::leftJoin('evolutions',
            'evolutions.filiere_id', '=',
            'filieres.id')
        ->where('filiere_id',$id)
        ->count();
        
        Debugbar::info($nbreRelation);

        if($nbreRelation!=0){
            return false;

        } else{
            $filiere = Filiere::find($id);

            return $filiere->delete();

        }
    }

    /**
     * @return int
     */

    public function count() {
        return Filiere::count();
    }

    public function list()
    {
        return $filiere = Filiere::select()
        ->orderBy('nom', 'asc')
        ->get()
        ->toArray();
    }


}
