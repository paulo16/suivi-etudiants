<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AccueilService;
use App\Services\EtablissementService;
use App\Services\EtudiantService;
use App\Services\FiliereService;
use App\Services\UserService;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller {

	public function __construct(UserService $userService, EtudiantService $etudiantservice,
		EtablissementService $etablissementService,
		FiliereService $filiereService, AccueilService $accueilService) {
		//parent::__construct();
		$this->userService = $userService;
		$this->etudiantservice = $etudiantservice;
		$this->etablissementservice = $etablissementService;
		$this->filiereservice = $filiereService;
		$this->accueilService = $accueilService;

	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {
		$users = $this->userService->count();
		$etudiants = $this->etudiantservice->countEtudiant();
		$etablissements = $this->etablissementservice->count();
		$filieres = $this->filiereservice->count();
		$statsvilles = $this->accueilService->statsParAnnees();

		return view('admin.index', compact(['users', 'etudiants',
			'etablissements', 'filieres', 'statsvilles']));
	}

}
