<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Pays;
use App\Models\Etudiant;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use EntrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','prenom','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function pays()
    {
        
        return $this->belongsTo(Pays::class);
    }

    public function etudiants()
    {

        return $this->belongsToMany(Etudiant::class);
    }
}
