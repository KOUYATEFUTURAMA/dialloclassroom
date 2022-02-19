<?php

namespace App\Http\Controllers\Education;

use Image;
use Exception;
use Illuminate\Http\Request;
use App\Models\Education\Cour;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Education\Enseignant;
use Illuminate\Support\Facades\Auth;

class EnseignantController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuPrincipal = "Education";
        $titleControlleur = "Liste des enseignants";
        $btnModalAjout = (Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur") ? "TRUE" : "FALSE";

        if(Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur"){
            return view('education.enseignant.index', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
        }else{
            return abort(404);
        }
    }

    public function listeEnseignant(){

        $enseignants = DB::table('enseignants')
                        ->select('enseignants.*')
                        ->orderBy('name', 'ASC')
                        ->get();

       $jsonData["rows"] = $enseignants->toArray();
       $jsonData["total"] = $enseignants->count();
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
        if ($request->isMethod('post') && $request->input('name')) {

                $data = $request->all();

            try {

                $enseignant = $data['id'] ? Enseignant::findOrFail($data['id']) : new Enseignant;
                $enseignant->name = $data['name'];
                $enseignant->contact = $data['contact'];
                $enseignant->email = isset($data['email']) ? $data['email'] : NULL;
                $enseignant->aff_sur_site = isset($data['aff_sur_site']) ? TRUE : FALSE;

                if(isset($data['image'])){
                    $file_name = 'image_prof'.date('dmYHis').'.jpg';

                    $img = Image::make($data['image']);
                    $img->save(storage_path('app/public/img/prof/'.$file_name),60);
                    $enseignant->image = '/storage/img/prof/'.$file_name;
                }

                $enseignant->save();

                $jsonData["data"] = json_decode($enseignant);
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
        $enseignant = Enseignant::find($id);

        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
            if($enseignant){
                try {
                //Vérifie si un cours est lié à ce mode on annule la supression du mode
                $cours = Cour::where('enseignant_id',$enseignant->id)->get();
                if($cours->count()>0){
                    return response()->json(["code" => 0, "msg" => "Impossible de supprimer cet enseignant.", "data" => NULL]);
                }   
                $enseignant->delete();
                $jsonData["data"] = json_decode($enseignant);
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
