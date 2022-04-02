<?php

namespace App\Http\Controllers\Education;

use Image;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Education\Cour;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modes = DB::table('modes')->select('id','libelle_mode')->orderBy('libelle_mode', 'ASC')->get();
        $categories = DB::table('categories')->where('blog',0)->select('id','libelle_categorie')->orderBy('libelle_categorie', 'ASC')->get();
        $enseignants = DB::table('enseignants')->select('id','name')->orderBy('name', 'ASC')->get();

        $menuPrincipal = "Education";
        $titleControlleur = "Liste des cours";
        $btnModalAjout = (Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur") ? "TRUE" : "FALSE";

        if(Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur"){
            return view('education.cours.index', compact('modes','categories','enseignants','menuPrincipal', 'titleControlleur', 'btnModalAjout'));
        }else{
            return abort(404);
        }
    }

    public function listeCours(string $libelle=NULL){
        if($libelle){
            $cours = Cour::with('mode','categorie','enseignant')
                        ->select('cours.*',DB::raw('DATE_FORMAT(date_cours, "%d-%m-%Y %H:%i") as dates_cours'),DB::raw('DATE_FORMAT(date_publication, "%d-%m-%Y %H:%i") as date_publications'))
                        ->where('libelle_cours','like', '%' . $libelle . '%')
                        ->orderBy('created_at', 'DESC')
                        ->get();
        }else{
            $cours = Cour::with('mode','categorie','enseignant')
                        ->select('cours.*',DB::raw('DATE_FORMAT(date_cours, "%d-%m-%Y %H:%i") as dates_cours'),DB::raw('DATE_FORMAT(date_publication, "%d-%m-%Y %H:%i") as date_publications'))
                        ->orderBy('created_at', 'DESC')
                        ->get();
        }

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

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];
        if ($request->isMethod('post') && $request->input('libelle_cours')) {

                $data = $request->all();

            try {

                $cours = $data['id'] ? Cour::findOrFail($data['id']) : new Cour;
                $cours->libelle_cours = $data['libelle_cours'];
                $cours->mode_id = $data['mode_id'];
                $cours->categorie_id = $data['categorie_id'];
                $cours->duree = $data['duree'];
                $cours->prix = $data['prix'];
                $cours->description = $data['description'];
                $cours->nombre_place = isset($data['nombre_place']) ? $data['nombre_place'] : 0;
                $cours->enseignant_id = isset($data['enseignant_id']) ? $data['enseignant_id'] : NULL;
                $cours->en_vedette = isset($data['en_vedette']) ? TRUE : FALSE;
                if(isset($data['publier'])){
                    $cours->publier = TRUE;
                    $cours->date_publication = Now();
                }else{
                    $cours->publier = FALSE;
                }
                $cours->date_cours = isset($data['date_cours']) ? Carbon::createFromFormat('d-m-Y H:i', $data['date_cours']) : NULL;

                if(isset($data['image_descriptive'])){
                    $file_name = 'image_descriptive'.date('dmYHis').'.jpg';

                    $img = Image::make($data['image_descriptive']);
                    $img->resize(350, 200);
                    $img->save(storage_path('app/public/img/image_descriptive/'.$file_name),60);
                    $cours->image_descriptive = '/storage/img/image_descriptive/'.$file_name;

                    $imgSlider = Image::make($data['image_descriptive']);
                    //$imgSlider->resize(450, 300);
                    $imgSlider->save(storage_path('app/public/img/image_descriptive_slider/'.$file_name),60);
                    $cours->image_descriptive_slider = '/storage/img/image_descriptive_slider/'.$file_name;
                }

                if(isset($data['video_descriptive'])){
                    $video = request()->file('video_descriptive');
                    $file_extention = strtolower($video->getClientOriginalExtension());
                    $allowedExtensions = array('mp4', 'mov', 'ogg', 'avi');

                    //Convertir la taille du fichier en Mo
                    $fileSize = number_format($video->getSize() / 1048576, 2);

                    if (!in_array($file_extention, $allowedExtensions)) {
                        return response()->json(["code" => 0, "msg" => "L'extension de votre fichier vidéo doit etre mp4, mov ou ogg", "data" => NULL]);
                    }
                    //La video ne doit pas depasser 55Mo
                    if($fileSize > 100){
                        return response()->json(["code" => 0, "msg" => "La taille de votre vidéo ne doit pas dépasser 100 Mo", "data" => NULL]);
                    }

                    $file_name = str::slug($data['libelle_cours']).'_'.date("dmYHis").'.'. $file_extention;

                    $video->move(storage_path('app/public/video/video_descriptive/'),$file_name);
                    $cours->video_descriptive = '/storage/video/video_descriptive/'.$file_name;
                }
            
                if(isset($data['video_cours'])){
                    $video = request()->file('video_cours');
                    $file_extention = strtolower($video->getClientOriginalExtension());

                    $file_name = str::slug($data['libelle_cours']).'_'.date("dmYHis").'.'. $file_extention;

                    $video->move(storage_path('app/public/video/video_cours/'),$file_name);
                    $cours->video_cours = '/storage/video/video_cours/'.$file_name;
                }
                
                $cours->save();
                $jsonData["data"] = json_decode($cours);
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
        $cours = Cour::find($id);

        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
            if($cours){
                try {
                //Suppression dans les dossiers lié a l'enregistrement
                if($cours->image_descriptive){
                    unlink(public_path().$cours->image_descriptive);
                }
                if($cours->video_descriptive){
                    unlink(public_path().$cours->video_descriptive);
                }
                if($cours->video_cours){
                    unlink(public_path().$cours->video_cours);
                }
                $cours->delete();
                $jsonData["data"] = json_decode($cours);
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
