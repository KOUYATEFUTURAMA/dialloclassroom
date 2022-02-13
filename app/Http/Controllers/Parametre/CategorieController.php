<?php

namespace App\Http\Controllers\Parametre;

use Exception;
use Illuminate\Http\Request;
use App\Models\Education\Cour;
use Illuminate\Support\Facades\DB;
use App\Models\Parametre\Categorie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuPrincipal = "Parametre";
        $titleControlleur = "Liste des catégories de cours";
        $btnModalAjout = (Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur") ? "TRUE" : "FALSE";

        if(Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur"){
            return view('parametre.categorie.index', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
        }else{
            return abort(404);
        }
    }

    public function categorieBlog(){

        $menuPrincipal = "Parametre";
        $titleControlleur = "Liste des catégories de blog";
        $btnModalAjout = (Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur") ? "TRUE" : "FALSE";

        if(Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur"){
            return view('parametre.categorie.categorie-blog', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
        }else{
            return abort(404);
        }
    }

    public function listeCategorie(){

        $categories = DB::table('categories')->where('blog',0)
                        ->select('categories.*')
                        ->orderBy('libelle_categorie', 'ASC')
                        ->get();

       $jsonData["rows"] = $categories->toArray();
       $jsonData["total"] = $categories->count();
       return response()->json($jsonData);
    }

    public function listeCategorieBlog(){

        $categories = DB::table('categories')->where('blog',1)
                        ->select('categories.*')
                        ->orderBy('libelle_categorie', 'ASC')
                        ->get();

       $jsonData["rows"] = $categories->toArray();
       $jsonData["total"] = $categories->count();
       return response()->json($jsonData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];
        if ($request->isMethod('post') && $request->input('libelle_categorie')) {

                $data = $request->all();

            try {

                $Categorie = Categorie::where([['libelle_categorie', $data['libelle_categorie']],['id','!=',$data['id']]])->first();
                if($Categorie){
                    return response()->json(["code" => 0, "msg" => "Cet enregistrement existe déjà dans la base", "data" => NULL]);
                }

                $categorie = $data['id'] ? Categorie::findOrFail($data['id']) : new Categorie;
                $categorie->libelle_categorie = $data['libelle_categorie'];
                $categorie->blog = isset($data['blog']) ? TRUE : FALSE;
                $categorie->save();

                $jsonData["data"] = json_decode($categorie);
                return response()->json($jsonData);

            } catch (Exception $exc) {
               $jsonData["code"] = -1;
               $jsonData["data"] = NULL;
               $jsonData["msg"] = $exc->getMessage();
               return response()->json($jsonData);
            }
        }
        return response()->json(["code" => 0, "msg" => "Saisie invalide", "data" => NULL]);
    }

    public function destroy($id)
    {
        $categorie = Categorie::find($id);

        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
            if($categorie){
                try {

                    /*Vérifie si un cours est lié à la categorie on annule la supression de la catégorie*/
                $cours = Cour::where('categorie_id',$categorie->id)->get();
                if($cours->count()>0){
                    return response()->json(["code" => 0, "msg" => "Impossible de supprimer cette catégorie.", "data" => NULL]);
                }   
                $categorie->delete();
                $jsonData["data"] = json_decode($categorie);
                return response()->json($jsonData);

                } catch (Exception $exc) {
                   $jsonData["code"] = -1;
                   $jsonData["data"] = NULL;
                   $jsonData["msg"] = $exc->getMessage();
                   return response()->json($jsonData);
                }
            }
        return response()->json(["code" => 0, "msg" => "Echec de suppression", "data" => NULL]);
    }
}
