<?php

namespace App\Http\Controllers\Admin;

use App\Services\UserService;
use App\Services\EtudiantService;
use App\Services\EtablissementService;
use App\Services\FiliereService;
use App\Services\AccueilService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{

	public function __construct(UserService $userService, EtudiantService $etudiantservice,
		EtablissementService $etablissementService,
		FiliereService $filiereService, AccueilService $accueilService)
	{
        //parent::__construct();
		$this->userService = $userService;
		$this->etudiantservice = $etudiantservice;
		$this->etablissementservice = $etablissementService;
		$this->filiereservice = $filiereService;
		$this->accueilService = $accueilService;


	}

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
        {
        	$nbusers = $this->userService->countUser();
        	$nbetudiants = $this->etudiantservice->countEtudiant();
        	$nbetablissements = $this->etablissementservice->countEtablissement();
        	$nbfilieres = $this->filiereservice->countFiliere();
        	$statsvilles=$this->accueilService->statsParAnnees();

        	$etablissements = $this->etablissementservice->listetablissement();
        	$villes = $this->etudiantservice->listevilles();
        	$filieres = $this->filiereservice->listefilieres();

        	return view('admin.stats.index',compact(['etudiant','etablissements','villes','filieres','nbusers',
        		'nbetudiants','nbetablissements','nbvilles','nbfilieres','statsvilles']));
        }
    }
