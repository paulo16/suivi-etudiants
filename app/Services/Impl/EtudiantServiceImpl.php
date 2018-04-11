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


    public function update(Request $request, $id)
    {
        $etudiant= Etudiant::find($id);
        $etudiant ->nom = $request->get('nom')? $request->get('nom') : '';
        $etudiant ->prenom = $request->get('prenom')? $request->get('prenom') : '';
        $etudiant ->email = $request->get('email')? $request->get('email') : '';
        $etudiant ->tel            = $request->get('tel')? $request->get('tel') : '';
        $etudiant ->date_naissance = $request->get('date_naissance')? $request->get('date_naissance') : '';
        $etudiant ->lieu_naissance = $request->get('lieu_naissance')? $request->get('lieu_naissance') : '';
        $etudiant ->status = $request->get('status')? $request->get('status') : '';
        $etudiant ->promotion = $request->get('promotion')? $request->get('promotion') : '';
        $etudiant ->genre = $request->get('genre')? $request->get('genre') : '';
        $etudiant ->adresse = $request->get('adresse')? $request->get('adresse') : '';

        if( $etudiant->save()){
            $evolution = Evolution::where('etudiant_id',$id)->orderBy('id','desc')->first();

            $evolution->situation =$request->get('status')? $request->get('status') : '';
            $evolution->niveau = $request->get('niveau')? $request->get('niveau') : '';
            $evolution->annee= $request->get('promotion')? $request->get('promotion') : '';
            $evolution->etablissement_id= $request->get('etablissements')? $request->get('etablissements') : '';
            $evolution->filiere_id=$request->get('filieres')? $request->get('filieres') : '';
            $evolution->ville_id=$request->get('villes')? $request->get('villes') : '';
            $evolution->etudiant_id= $etudiant->id;
            $evolution->save();
        }

        return $etudiant ;
    }

    public function store(Request $request)

    {
        $etudiant= new Etudiant();
        $etudiant ->nom = $request->get('nom')? $request->get('nom') : '';
        $etudiant ->prenom = $request->get('prenom')? $request->get('prenom') : '';
        $etudiant ->email = $request->get('email')? $request->get('email') : '';
        $etudiant ->tel  = $request->get('tel')? $request->get('tel') : '';
        $etudiant ->date_naissance = $request->get('date_naissance')? $request->get('date_naissance') : '';
        $etudiant ->lieu_naissance = $request->get('lieu_naissance')? $request->get('lieu_naissance') : '';
        $etudiant ->status = $request->get('status')? $request->get('status') : '';
        $etudiant ->promotion = $request->get('promotion')? $request->get('promotion') : '';
        $etudiant ->genre = $request->get('genre')? $request->get('genre') : '';
        $etudiant ->adresse = $request->get('adresse')? $request->get('adresse') : '';

        if( $etudiant->save()){
            $evolution = new Evolution();

            $evolution->situation =$request->get('status')? $request->get('status') : '';
            $evolution->niveau = $request->get('niveau')? $request->get('niveau') : '';
            $evolution->annee= $request->get('promotion')? $request->get('promotion') : '';
            $evolution->etablissement_id= $request->get('etablissements')? $request->get('etablissements') : '';
            $evolution->filiere_id=$request->get('filieres')? $request->get('filieres') : '';
            $evolution->ville_id=$request->get('villes')? $request->get('villes') : '';
            $evolution->etudiant_id= $etudiant->id;
            $evolution->save();
        }

        return $etudiant ;
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
            'etudiants.tel as tel', 'etudiants.email as email','etudiants.adresse as adresse',
            'etudiants.date_naissance as naissance', 'etudiants.genre as genre','etudiants.promotion as promo',
            'etudiants.lieu_naissance as lieu_naissance', 'evolutions.annee as promotion','evolutions.niveau as niveau',
            'villes.nom as ville', 'filieres.nom as filiere', 'etablissements.nom as ecole', 'evolutions.situation as situation', 'evolutions.id as id_evolution')
        ->where('evolutions.etudiant_id', '=', $id)
        ->orderBy('evolutions.id','desc')
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
            8  => 'situation',
            9  => 'naissance',
            10  => 'tel',
            11 => 'email',
            12 => 'action',
            13 => 'numero',
            14 => 'archiver'
        );

        $totalData = Etudiant::count();

        $totalFiltered = $totalData;
        

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        Debugbar::info($request->get('filtre'));
        if (empty($request->input('search.value')) && empty($request->input('filtre'))) {
            Debugbar::info('depart');

            $etudiants =\DB::table('etudiants')
            ->leftJoin(\DB::raw('(SELECT * FROM evolutions A WHERE id = (SELECT MAX(id) FROM evolutions B WHERE A.etudiant_id=B.etudiant_id)) AS evo'), function($join) {
                $join->on('etudiants.id', '=', 'evo.etudiant_id');
            })
            ->join('villes', 'evo.ville_id', '=', 'villes.id')
            ->join('filieres', 'evo.filiere_id', '=', 'filieres.id')
            ->join('etablissements', 'evo.etablissement_id', '=', 'etablissements.id')
            ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.tel as tel', 'etudiants.prenom as prenom',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre',
                'etudiants.promotion as promotion', 'villes.nom as ville', 'villes.id as ville_id',
                'filieres.nom as filiere', 'etudiants.email as email','etudiants.archive as archive',
                'etablissements.nom as ecole', 'evo.situation as situation')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        } elseif ( empty($request->input('search.value')) && $request->input('filtre')) {
            $filtre=[];

            foreach ($request->get('filtre') as $key => $value) {
                if($value && $key=="nom") $filtre['etudiants.nom']=$value ;
                if($value && $key=="prenom") $filtre['etudiants.prenom']=$value ;
                if($value && $key=="status") $filtre['evo.situation']=$value ;
                if($value && $key=="archiver"){
                   
                    $filtre['etudiants.archive']= ($value == "true") ? true : false ;
                }
                if($value && $key=="genre") $filtre['etudiants.genre']=$value ;
                if($value && $key=="promotion") $filtre['etudiants.promotion']=$value ;
                if($value && $key=="ville") $filtre['evo.ville_id']=$value ;
                if($value && $key=="etablissement") $filtre['evo.etablissement_id']=$value ;
                if($value && $key=="filiere") $filtre['evo.filiere_id']=$value ;
            }


            $etudiants =\DB::table('etudiants')
            ->leftJoin(\DB::raw('(SELECT * FROM evolutions A WHERE id = (SELECT MAX(id) FROM evolutions B WHERE A.etudiant_id=B.etudiant_id)) AS evo'), function($join) {
                $join->on('etudiants.id', '=', 'evo.etudiant_id');
            })
            ->join('villes', 'evo.ville_id', '=', 'villes.id')
            ->join('filieres', 'evo.filiere_id', '=', 'filieres.id')
            ->join('etablissements', 'evo.etablissement_id', '=', 'etablissements.id')
            ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.tel as tel', 'etudiants.prenom as prenom',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre',
                'etudiants.promotion as promotion', 'villes.nom as ville', 'villes.id as ville_id',
                'filieres.nom as filiere', 'etudiants.email as email','etudiants.archive as archive',
                'etablissements.nom as ecole', 'evo.situation as situation')
            ->where($filtre)
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

            $totalFiltered = \DB::table('etudiants')
            ->leftJoin(\DB::raw('(SELECT * FROM evolutions A WHERE id = (SELECT MAX(id) FROM evolutions B WHERE A.etudiant_id=B.etudiant_id)) AS evo'), function($join) {
                $join->on('etudiants.id', '=', 'evo.etudiant_id');
            })
            ->join('villes', 'evo.ville_id', '=', 'villes.id')
            ->join('filieres', 'evo.filiere_id', '=', 'filieres.id')
            ->join('etablissements', 'evo.etablissement_id', '=', 'etablissements.id')
            ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.tel as tel', 'etudiants.prenom as prenom',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre',
                'etudiants.promotion as promotion', 'villes.nom as ville', 'villes.id as ville_id',
                'filieres.nom as filiere', 'etudiants.email as email','etudiants.archive as archive',
                'etablissements.nom as ecole', 'evo.situation as situation')
            ->where($filtre)
            ->count();

            Debugbar::info($totalFiltered);


        }else {
            Debugbar::info('filtre natif');
            $search = $request->input('search.value');
            $etudiants =\DB::table('etudiants')
            ->leftJoin(\DB::raw('(SELECT * FROM evolutions A WHERE id = (SELECT MAX(id) FROM evolutions B WHERE A.etudiant_id=B.etudiant_id)) AS evo'), function($join) {
                $join->on('etudiants.id', '=', 'evo.etudiant_id');
            })
            ->join('villes', 'evo.ville_id', '=', 'villes.id')
            ->join('filieres', 'evo.filiere_id', '=', 'filieres.id')
            ->join('etablissements', 'evo.etablissement_id', '=', 'etablissements.id')
            ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.tel as tel', 'etudiants.prenom as prenom',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre',
                'etudiants.promotion as promotion', 'villes.nom as ville', 'villes.id as ville_id',
                'filieres.nom as filiere', 'etudiants.email as email','etudiants.archive as archive',
                'etablissements.nom as ecole', 'evo.situation as situation')
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
            ->orWhere('evo.situation', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

            $totalFiltered = \DB::table('etudiants')
            ->leftJoin(\DB::raw('(SELECT * FROM evolutions A WHERE id = (SELECT MAX(id) FROM evolutions B WHERE A.etudiant_id=B.etudiant_id)) AS evo'), function($join) {
                $join->on('etudiants.id', '=', 'evo.etudiant_id');
            })
            ->join('villes', 'evo.ville_id', '=', 'villes.id')
            ->join('filieres', 'evo.filiere_id', '=', 'filieres.id')
            ->join('etablissements', 'evo.etablissement_id', '=', 'etablissements.id')
            ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.tel as tel', 'etudiants.prenom as prenom',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre',
                'etudiants.promotion as promotion', 'villes.nom as ville', 'villes.id as ville_id',
                'filieres.nom as filiere', 'etudiants.email as email','etudiants.archive as archive',
                'etablissements.nom as ecole', 'evo.situation as situation')
            ->where('etudiants.nom', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.prenom', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.date_naissance', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.genre', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.promotion', 'LIKE', "%{$search}%")
            ->orWhere('villes.nom', 'LIKE', "%{$search}%")
            ->orWhere('filieres.nom', 'LIKE', "%{$search}%")
            ->orWhere('etablissements.nom', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.tel', 'LIKE', "%{$search}%")
            ->orWhere('evo.situation', 'LIKE', "%{$search}%")
            ->orWhere('etudiants.email', 'LIKE', "%{$search}%")
            ->count();
        }

        $data = array();
        $numero=0;

        if (!empty($etudiants)) {


            $url='<a href=":url" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Editer</a>';
            $delete='<a data-id=":id" class="btn btn-xs btn-danger btn-primary delete"><i class="glyphicon glyphicon-remove"></i>sup</a>';
            $archive='<a data-id=":id" class="btn btn-xs btn-primary archive"><i class="glyphicon glyphicon-off">
            </i>&nbsp;:nom&nbsp;</a>';

            foreach ($etudiants as $etudiant) {
                $show = route('etudiants.show', $etudiant->id);
                $edit = route('etudiants.edit', $etudiant->id);
                $del =str_replace(":id",$etudiant->id,$delete); 
                //
                $rep=$etudiant->archive ? " OUI " : " NON " ;
                $arch =str_replace(":id",$etudiant->id,$archive); 
                $arch =str_replace(":nom",$rep,$arch); 

                $nestedData['numero']    = $numero ++ ;
                $nestedData['genre']     = $etudiant->genre ? $etudiant->genre: '-';
                $nestedData['promotion'] = $etudiant->promotion ? $etudiant->promotion :'-';
                $nestedData['ville']     = $etudiant->ville ? $etudiant->ville: '-';
                $nestedData['filiere']   = $etudiant->filiere ? $etudiant->filiere: '-';
                $nestedData['ecole']     = $etudiant->ecole? $etudiant->ecole : '';
                $nestedData['nom']       = "<a href='{$show}' title='SHOW' >" . $etudiant->nom . "</a>";
                $nestedData['prenom']    = "<a href='{$show}' title='SHOW' >" . $etudiant->prenom . "</a>";
                $nestedData['naissance'] = "<a href='{$show}' title='SHOW' >" . $etudiant->naissance . "</a>";
                $nestedData['situation'] = $etudiant->situation ? $etudiant->situation : '-';
                $nestedData['tel']       = $etudiant->tel ? $etudiant->tel:'-';
                $nestedData['email']     = $etudiant->email ? $etudiant->email:'-';
                $nestedData['archive']     = $arch;
                $nestedData['action'] = '&nbsp;'.$del; 
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
            'etudiants.date_naissance as naissance', 'etudiants.genre as genre', 'evolutions.annee as annee', 'villes.nom as ville', 'filieres.nom as filiere', 'evolutions.niveau as niveau','etablissements.nom as ecole', 'evolutions.situation as situation','evolutions.id as id_evolution')
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

    public function archiver($id){

        $etudiant= Etudiant::find($id);
        $etudiant ->archive = !$etudiant ->archive;

        return $etudiant->save() ;

    }

}
