<?php

namespace app\Models;

use App\Models\Etudiant;
use App\Models\Etablissement;
use App\Models\Filiere;
use App\Models\Ville;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Evolution
 * @package app\Models
 */
class Evolution extends Model
{
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function etablissements()
    {
        return $this->hasMany(Etablissement::class);
    }

    public function filieres()
    {
        return $this->hasMany(Filiere::class);
    }

    public function villes()
    {
        return $this->hasMany(Ville::class);
    }
}
