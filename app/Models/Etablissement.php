<?php

namespace App\Models;

use App\Models\Evolution;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Etablissement
 * @package App\Models
 */
class Etablissement extends Model
{

    public function evolution()
    {
        return $this->belongsTo(Evolution::class);
    }
}
