<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $fillable = ['nom','contact','email','image','aff_sur_site'];
}
