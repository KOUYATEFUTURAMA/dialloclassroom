<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name','contact','cour_id','blog_id','avis_favo','content'];

    public function cour(){
        return $this->belongsTo('App\Models\Education\Cour');
    }

    public function blog(){
        return $this->belongsTo('App\Models\Education\Blog');
    }
}
