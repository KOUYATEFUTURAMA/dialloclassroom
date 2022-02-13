<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name','contact','email','adresse'];

}
