<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name','sujet','email','contact','message'];

}
