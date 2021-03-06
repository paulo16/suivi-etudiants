<?php

namespace App\Services;

use Illuminate\Http\Request;

/**
 *Intefaces des étudiants
 **/
interface EvolutionService
{

	public function evolutions($id);
	public function update(Request $request, $id);
	public function store(Request $request);
	public function delete($id);

}