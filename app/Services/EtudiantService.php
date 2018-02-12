<?php

namespace App\Services;

use Illuminate\Http\Request;

/**
 *Intefaces des étudiants
 **/
interface EtudiantService
{

    public function update(Request $request, $id);

    public function store(Request $request);

    public function find($id);

    public function delete($id);

    public function countEtudiant();
    
    public function infoEtudiant($id);

    public function listetudiants(Request $request);

    public function evolutionEtudiant($id);

    public function listevilles();

}
