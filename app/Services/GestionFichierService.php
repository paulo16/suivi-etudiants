<?php

namespace App\Services;

use Illuminate\Http\Request;

/**
 *Intefaces pour Gestion fichiers
 **/

interface GestionFichierService {

	public function importExcel(Request $request);

}
