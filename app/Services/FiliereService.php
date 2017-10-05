<?php

namespace App\Services;

/**
 *Intefaces des Filière
 **/

interface FiliereService
{

    public function allFiliereDatatable();

    public function updateFiliere($request, $id);

    public function createFiliere($request);

    public function findFiliere($id);

    public function deleteFiliere($id);

    public function countFiliere();

}