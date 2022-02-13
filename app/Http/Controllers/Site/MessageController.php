<?php

namespace App\Http\Controllers\Site;

use Exception;
use App\Models\Site\Message;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuPrincipal = "Site";
        $titleControlleur = "Liste des messages";
        $btnModalAjout = "FALSE";

        if(Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur"){
            return view('site.messages', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
        }else{
            return abort(404);
        }
    }

    public function listeMessage(){
        $messages = Message::select('messages.*')
                        ->orderBy('created_at', 'DESC')
                        ->get();

       $jsonData["rows"] = $messages->toArray();
       $jsonData["total"] = $messages->count();
       return response()->json($jsonData);
    }

    public function destroy($id)
    {
        $message = Message::find($id);

        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
            if($message){
                try {
                  
                    $message->delete();
                    $jsonData["data"] = json_decode($message);
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
