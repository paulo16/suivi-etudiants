<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Services\GestionFichierService;
use Excel;
use Illuminate\Http\Request;

/**
 * Class GestionFicherController
 * @package App\Http\Controllers\Admin
 */
class GestionFicherController extends Controller {

	public function __construct(GestionFichierService $gestionFichierService) {
		$this->middleware('web');
		$this->middleware('auth');

		$this->gestionFichierService = $gestionFichierService;
	}
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function importExport() {
		return view('admin.gestioncsv.importcsv');
	}

	/**
	 * @param $type
	 * @return mixed
	 */

	public function downloadExcel($type) {
		$etudiants = Etudiant::get()->toArray();
		return Excel::create('tous_les_etudiants_camerounais', function ($excel) use ($etudiants) {
			$excel->sheet('etudiants', function ($sheet) use ($etudiants) {
				$sheet->fromArray($etudiants);
			});
		})->download($type);
	}

	public function importExcel(Request $request) {
		$result = $this->gestionFichierService->importExcel($request);
		return view('admin.gestioncsv.importcsv', ['result' => $result]);
	}
}
