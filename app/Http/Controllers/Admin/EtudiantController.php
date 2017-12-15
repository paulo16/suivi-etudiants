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
        return view('admin.etudiant.list');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(EtudiantsDataTable $dataTable)
    {
        //return $this->etudiantservice->datatable();
        return $dataTable->render('admin.etudiant.listetudiant');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->etudiantservice->create($request);
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

        return view('admin.etudiant.edit', compact(['etudiant']));
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
        return $this->etudiantservice->update($request, $id);
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
        $etablissements = $this->etablissementservice->listetablissement();
        $villes = $this->etudiantservice->listevilles();
        $filieres = $this->filiereservice->listefilieres();
        $etudiant =$this->etudiantservice->infoEtudiant($id);
        return compact(['etudiant','etablissements','villes','filieres']) ;
    }

    public function evolutions($id)
    {
        $etablissements = $this->etablissementservice->listetablissement();
        $villes = $this->etudiantservice->listevilles();
        $filieres = $this->filiereservice->listefilieres();
        $evolutions = $this->evolutionService->evolutions($id);
        //dd($evolutions);
        return compact(['evolutions','etablissements','villes','filieres']) ;
    }


    public function aides()
    {
        $etablissements = $this->etablissementservice->listetablissement();
        $villes = $this->etudiantservice->listevilles();
        $filieres = $this->filiereservice->listefilieres();
        return compact(['etablissements','villes','filieres']) ;
    }

}
