<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\EtudiantService;
use App\Services\EvolutionService;
use DB;
use PDF;

class PdfGenerateController extends Controller
{

    public function __construct(EtudiantService $etudiantservice
        ,EvolutionService $evolutionService)
    {

        $this->etudiantservice = $etudiantservice;
        $this->evolutionService = $evolutionService;

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview($id)
    {
       $etudiant =$this->etudiantservice->infoEtudiant($id);
       $evolutions = $this->etudiantservice->evolutionEtudiant($id);;
       //dd($evolutions);
       $data=compact(["etudiant","evolutions"]);

       view()->share('data',$data);

       PDF::setOptions([
        'dpi' => 150, 
        'defaultFont' => 'sans-serif',
         ]);
            // pass view file
       $pdf = PDF::loadView('admin.etudiant.pdfetudiant');
            // download pdf
       return $pdf->download($etudiant->nom.'-fiche.pdf');
     //return $pdf->stream();
   }
}