<?php

namespace App\Http\Controllers\Admin;

use App\Services\UserService;
use App\Services\EtudiantService;
use App\Services\EtablissementService;
use App\Services\FiliereService;
use App\Services\AccueilService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userService->countUser();
        $etudiants = $this->etudiantservice->countEtudiant();
        $etablissements = $this->etablissementservice->countEtablissement();
        $filieres = $this->filiereservice->countFiliere();
        $statsvilles=$this->accueilService->statsParAnnees();

        return view('admin.index', compact(['users', 'etudiants',
            'etablissements', 'filieres','statsvilles']));
    }



}
