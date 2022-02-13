<?php

namespace App\Models\Education;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'titre_blog',
        'categorie_id',
        'image',
        'content',
        'publier',
        'image_detail'
    ];

    protected $dates = ['date_event'];

    public function categorie() {
        return $this->belongsTo('App\Models\Parametre\Categorie');
    }

    public function link()
    {
        return route('web.blog-details', [ 'slug' => Str::slug($this->titre_blog), 'id' => $this->id ]);
    }
}
