<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Echeance extends Model
{
    protected $fillable = ['reservation_id','montant'];

    protected $dates = ['date_payement'];

    public function reservation(){
        return $this->belongsTo('App\Models\Site\Reservation');
    }
}
