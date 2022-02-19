<?php

namespace App\Http\Controllers\Site;

use Exception;
use App\Models\Site\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuPrincipal = "Site";
        $titleControlleur = "Vidéos";
        $btnModalAjout = (Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur") ? "TRUE" : "FALSE";

        if(Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur"){
            return view('site.video', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
        }else{
            return abort(404);
        }
    }

    public function listeVideo(){

        $videos = DB::table('videos')
                        ->select('videos.*')
                        ->orderBy('id', 'DESC')
                        ->get();

       $jsonData["rows"] = $videos->toArray();
       $jsonData["total"] = $videos->count();
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
        if ($request->isMethod('post')) {

                $data = $request->all();

            try {

                $videos = $data['id'] ? Video::findOrFail($data['id']) : new Video;

                $videos->titre = $data['titre'];
             
                if(isset($data['video'])){
                    
                    $video = request()->file('video');
                    $file_extention = strtolower($video->getClientOriginalExtension());
                    $allowedExtensions = array('mp4', 'mov', 'ogg', 'avi');

                    //Convertir la taille du fichier en Mo
                    $fileSize = number_format($video->getSize() / 1048576, 2);

                    if (!in_array($file_extention, $allowedExtensions)) {
                        return response()->json(["code" => 0, "msg" => "L'extension de votre fichier vidéo doit etre mp4, mov ou ogg", "data" => NULL]);
                    }
                    //La video ne doit pas depasser 5Mo
                    if($fileSize > 5){
                        return response()->json(["code" => 0, "msg" => "La taille de votre vidéo ne doit pas dépasser 25 Mo", "data" => NULL]);
                    }

                    $file_name = 'video_pre_'.date("dmYHis").'.'. $file_extention;

                    $video->move(storage_path('app/public/video/video/'),$file_name);
                    
                    $videos->video = '/storage/video/video/'.$file_name;
                }
                   
                $videos->save();
                $jsonData["data"] = json_decode($videos);
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
        $video = Video::find($id);

        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
            if($video){
                try {
                //Suppression dans les dossiers lié a l'enregistrement
                if($video->video){
                    unlink(public_path().$video->video);
                }
                
                $video->delete();
                $jsonData["data"] = json_decode($video);
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
