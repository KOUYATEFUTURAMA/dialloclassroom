<?php

namespace App\Http\Controllers\API;

use App\Models\Education\Cour;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CourController extends Controller
{
    public function listeCours()
    {
        $cours = Cour::with('mode','categorie','enseignant')
                        ->select('cours.*',DB::raw('DATE_FORMAT(date_cours, "%d-%m-%Y %H:%i") as dates_cours'),DB::raw('DATE_FORMAT(date_publication, "%d-%m-%Y %H:%i") as date_publications'))
                        ->orderBy('created_at', 'DESC')
                        ->get();
        $jsonData["rows"] = $cours->toArray();
        $jsonData["total"] = $cours->count();
        return response()->json($jsonData);
    }

    public function listeCoursByLibelle($libelle){
        $cours = Cour::with('mode','categorie','enseignant')
                        ->select('cours.*',DB::raw('DATE_FORMAT(date_cours, "%d-%m-%Y %H:%i") as dates_cours'),DB::raw('DATE_FORMAT(date_publication, "%d-%m-%Y %H:%i") as date_publications'))
                        ->where('libelle_cours','like', '%' . $libelle . '%')
                        ->orderBy('created_at', 'DESC')
                        ->get();
        $jsonData["rows"] = $cours->toArray();
        $jsonData["total"] = $cours->count();
        return response()->json($jsonData);
    }

    public function listeCoursByMode($mode){
        $cours = Cour::with('mode','categorie','enseignant')
                        ->select('cours.*',DB::raw('DATE_FORMAT(date_cours, "%d-%m-%Y %H:%i") as dates_cours'),DB::raw('DATE_FORMAT(date_publication, "%d-%m-%Y %H:%i") as date_publications'))
                        ->where('mode_id',$mode)
                        ->orderBy('created_at', 'DESC')
                        ->get();
        $jsonData["rows"] = $cours->toArray();
        $jsonData["total"] = $cours->count();
        return response()->json($jsonData);
    }

    public function listeCoursByCategorie($categorie){
        $cours = Cour::with('mode','categorie','enseignant')
                        ->select('cours.*',DB::raw('DATE_FORMAT(date_cours, "%d-%m-%Y %H:%i") as dates_cours'),DB::raw('DATE_FORMAT(date_publication, "%d-%m-%Y %H:%i") as date_publications'))
                        ->where('categorie_id',$categorie)
                        ->orderBy('created_at', 'DESC')
                        ->get();
        $jsonData["rows"] = $cours->toArray();
        $jsonData["total"] = $cours->count();
        return response()->json($jsonData);
    }

    public function listeCoursByModeCategorie($mode,$categorie){
        $cours = Cour::with('mode','categorie','enseignant')
                        ->select('cours.*',DB::raw('DATE_FORMAT(date_cours, "%d-%m-%Y %H:%i") as dates_cours'),DB::raw('DATE_FORMAT(date_publication, "%d-%m-%Y %H:%i") as date_publications'))
                        ->where([['categorie_id',$categorie],['mode_id',$mode]])
                        ->orderBy('created_at', 'DESC')
                        ->get();
        $jsonData["rows"] = $cours->toArray();
       $jsonData["total"] = $cours->count();
       return response()->json($jsonData);
    }
}
