<?php

namespace App\Models;

use App\Models\Evolution;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Filiere
 * @package App\Models
 */
class Filiere extends Model
{
    public function evolution()
    {
        return $this->belongsTo(Evolution::class);
    }
}
