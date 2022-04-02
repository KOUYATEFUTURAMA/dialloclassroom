<?php

namespace App\Models\Education;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    protected $fillable = [
        'libelle_cours',
        'mode_id',
        'categorie_id',
        'duree',
        'prix',
        'description',
        'nombre_place',
        'enseignant_id',
        'en_vedette',
        'publier',
        'video_descriptive',
        'image_descriptive',
        'image_descriptive_slider',
        'video_cours'
    ];

    public function mode() {
        return $this->belongsTo('App\Models\Parametre\Mode');
    }

    public function categorie() {
        return $this->belongsTo('App\Models\Parametre\Categorie');
    }

    public function enseignant() {
        return $this->belongsTo('App\Models\Education\Enseignant');
    }

    protected $dates = ['date_cours','date_publication'];

    public function link()
    {
        return route('web.cours-details', [ 'slug' => Str::slug($this->libelle_cours), 'id' => $this->id ]);
    }

    public function achatCour()
    {
        return route('web.achat-cour', [ 'slug' => Str::slug($this->libelle_cours), 'id' => $this->id ]);
    }
}
