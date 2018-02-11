<?php

namespace App\Services;

use Illuminate\Http\Request;

/**
 *Intefaces des établissement
 **/

interface EtablissementService
{

	public function listEtablissements(Request $request);

	public function update(Request $request, $id);

	public function store(Request $request);

	public function find($id);

	public function delete($id);

	public function count();

    public function list();

}