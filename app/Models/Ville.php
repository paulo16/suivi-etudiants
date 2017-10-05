<?php

namespace App\Models;

use App\Models\Evolution;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ville
 * @package App\Models
 */

class Ville extends Model
{
    public $timestamps = false; 
    
    public function evolution()
    {
        return $this->belongsTo(Evolution::class);
    }
}
