<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EtudiantsDataTable;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\EtudiantService;
use App\Services\EtablissementService;
use App\Services\FiliereService;
use App\Services\AccueilService;
use App\Services\EvolutionService;
use App\Models\Ville;
use App\Models\Evolution;
use App\Models\Etablissement;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EtudiantController extends Controller
{

    public function __construct(UserService $userService, EtudiantService $etudiantservice,
        EtablissementService $etablissementService,
        FiliereService $filiereService, AccueilService $accueilService,EvolutionService $evolutionService)
    {
        $this->middleware('web');
        $this->middleware('auth');

        $this->userService = $userService;
        $this->etudiantservice = $etudiantservice;
        $this->etablissementservice = $etablissementService;
        $this->filiereservice = $filiereService;
        $this->accueilService = $accueilService;
        $this->evolutionService = $evolutionService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(EtudiantsDataTable $dataTable)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villes = Ville::select()->orderBy('nom', 'asc') ->get() ->toArray();
        $etablissements = Etablissement::select()->orderBy('nom', 'asc') ->get() ->toArray();
        $filieres = Filiere::select()->orderBy('nom', 'asc') ->get() ->toArray();

        return view('admin.etudiant.add',compact('villes','etablissements','filieres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'filieres' => 'required',
            'etablissements' => 'required',
            'promotion' => 'required',
            'status' => 'required',
        ]);

        return $this->etudiantservice->store($request)? redirect()->route('etudiants.index'): redirect()->route('etudiants.create');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $etudiant   = $this->etudiantservice->infoEtudiant($id);
        $evolutions = $this->etudiantservice->evolutionEtudiant($id);
        //dd($evolutions);

        return view('admin.etudiant.profil', compact(['etudiant', 'evolutions']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $etudiant = $this->etudiantservice->infoEtudiant($id);
        $villes = Ville::select()->orderBy('nom', 'asc') ->get() ->toArray();
        $etablissements = Etablissement::select()->orderBy('nom', 'asc') ->get() ->toArray();
        $filieres = Filiere::select()->orderBy('nom', 'asc') ->get() ->toArray();

        return view('admin.etudiant.edit', compact('etudiant','evolution','villes','etablissements','filieres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'filieres' => 'required',
            'etablissements' => 'required',
            'promotion' => 'required',
            'status' => 'required',
        ]);

        if($this->etudiantservice->update($request, $id)) {
            return redirect(route('etudiants.show',$id));
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listall()
    {
        return view('admin.etudiant.listetudiants');
    }

    public function all(Request $request)
    {
        return $this->etudiantservice->listetudiants($request);
    }

    public function findinfo($id)
    {
        $etablissements = $this->etablissementservice->list();
        $villes = $this->etudiantservice->listevilles();
        $filieres = $this->filiereservice->list();
        $etudiant =$this->etudiantservice->infoEtudiant($id);
        return compact(['etudiant','etablissements','villes','filieres']) ;
    }

    public function evolutions($id)
    {
        $etablissements = $this->etablissementservice->list();
        $villes = $this->etudiantservice->listevilles();
        $filieres = $this->filiereservice->list();
        $evolutions = $this->evolutionService->evolutions($id);
        //dd($evolutions);
        return compact(['evolutions','etablissements','villes','filieres']) ;
    }


    public function aides()
    {
        $etablissements = $this->etablissementservice->list();
        $villes = $this->etudiantservice->listevilles();
        $filieres = $this->filiereservice->list();
        return compact(['etablissements','villes','filieres']) ;
    }

}
