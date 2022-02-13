<?php

namespace App\Http\Controllers\Parametre;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Education\Cour;
use App\Models\Parametre\Mode;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuPrincipal = "Parametre";
        $titleControlleur = "Liste des modes du cours";
        $btnModalAjout = (Auth::user()->role =="Concepteur") ? "TRUE" : "FALSE";

        if(Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur"){
            return view('parametre.mode.index', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
        }else{
            return abort(404);
        }
    }

    public function listeMode()
    {
        $modes = DB::table('modes')
                        ->select('modes.*')
                        ->orderBy('libelle_mode', 'ASC')
                        ->get();

       $jsonData["rows"] = $modes->toArray();
       $jsonData["total"] = $modes->count();
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
        if ($request->isMethod('post') && $request->input('libelle_mode')) {

                $data = $request->all();

            try {

                $Mode = Mode::where([['libelle_mode', $data['libelle_mode']],['id','!=',$data['id']]])->first();
                if($Mode){
                    return response()->json(["code" => 0, "msg" => "Cet enregistrement existe déjà dans la base", "data" => NULL]);
                }

                $mode = $data['id'] ? Mode::findOrFail($data['id']) : new Mode;
                $mode->libelle_mode = $data['libelle_mode'];
                $mode->slug = Str::slug($data['libelle_mode']);
                $mode->save();

                $jsonData["data"] = json_decode($mode);
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
        $mode = Mode::find($id);

        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
            if($mode){
                try {

                    //Vérifie si un cours est lié à ce mode on annule la supression du mode
                    $cours = Cour::where('mode_id',$mode->id)->get();
                    if($cours->count()>0){
                        return response()->json(["code" => 0, "msg" => "Impossible de supprimer ce mode.", "data" => NULL]);
                    }
                $mode->delete();
                $jsonData["data"] = json_decode($mode);
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
