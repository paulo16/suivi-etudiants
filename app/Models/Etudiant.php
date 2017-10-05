<?php

namespace App\Models;

use App\Models\Evolution;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Etudiant
 * @package App\Models
 */
class Etudiant extends Model
{

    protected $guarded = ['id'];

    public function users()
    {

        return $this->belongsToMany(User::class);
    }

    public function evolution()
    {

        return $this->belongsTo(Evolution::class);
    }
}
