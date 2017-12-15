<?php

namespace App\Services;

/**
 *Intefaces des établissement
 **/

interface EtablissementService
{

    public function allEtablissementDatatable();

    public function updateEtablissement($request, $id);

    public function createEtablissement($request);

    public function findEtablissement($id);

    public function deleteEtablissement($id);

    public function countEtablissement();

    public function listetablissement();

}