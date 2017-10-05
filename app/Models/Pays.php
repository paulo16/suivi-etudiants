<?php

namespace App\Models;

use App\Models\Evolution;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Pays
 * @package App\Models
 */
class Pays extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
