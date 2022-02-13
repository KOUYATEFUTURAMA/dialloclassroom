<?php

namespace App\Http\Controllers\Site;

use Exception;
use App\Models\Site\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuPrincipal = "Site";
        $titleControlleur = "Liste des commentaires";
        $btnModalAjout = "FALSE";

        if(Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur"){
            return view('site.commentaires', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
        }else{
            return abort(404);
        }
    }

    public function listeComment(){
        $comments = Comment::with('cour','blog')
                        ->select('comments.*')
                        ->orderBy('created_at', 'DESC')
                        ->get();

       $jsonData["rows"] = $comments->toArray();
       $jsonData["total"] = $comments->count();
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

                $comment = Comment::findOrFail($data['id']);

                $comment->avis_favo = isset($data['avis_favo']) ? TRUE : FALSE;

                $comment->save();
                $jsonData["data"] = json_decode($comment);
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
        $comment = Comment::find($id);

        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
            if($comment){
                try {
                  
                    $comment->delete();
                    $jsonData["data"] = json_decode($comment);
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
