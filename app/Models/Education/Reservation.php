<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['cours_id','amount','payment_method','description','operator_id','name_costumer','email_costumer','contact_costumer'];

    protected $dates = ['payment_date'];

    public function cours() {
        return $this->belongsTo('App\Models\Education\Cour', 'cours_id');
    }
}
