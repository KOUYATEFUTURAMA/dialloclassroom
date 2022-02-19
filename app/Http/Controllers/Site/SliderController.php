<?php

namespace App\Http\Controllers\Site;

use Image;
use Exception;
use App\Models\Site\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuPrincipal = "Site";
        $titleControlleur = "Slider";
        $btnModalAjout = (Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur") ? "TRUE" : "FALSE";

        if(Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur"){
            return view('site.slider', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
        }else{
            return abort(404);
        }
    }

    public function listeSlider(){

        $silders = DB::table('sliders')
                        ->select('sliders.*')
                        ->orderBy('id', 'DESC')
                        ->get();

       $jsonData["rows"] = $silders->toArray();
       $jsonData["total"] = $silders->count();
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

                $slider = $data['id'] ? Slider::findOrFail($data['id']) : new Slider;

                $slider->libelle_slider = isset($data['libelle_slider']) ? $data['libelle_slider'] : null;
             
               
                if(isset($data['image'])){
                    
                   $file_name = 'image_slider'.date('dmYHis').'.jpg';

                    $img = Image::make($data['image']);
                    $img->save(storage_path('app/public/img/slider/'.$file_name),60);
                    $slider->image = '/storage/img/slider/'.$file_name;
                }
                   
                $slider->save();
                $jsonData["data"] = json_decode($slider);
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
        $slider = Slider::find($id);

        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
            if($slider){
                try {
                //Suppression dans les dossiers lié a l'enregistrement
                if($slider->image){
                    unlink(public_path().$slider->image);
                }
                
                $slider->delete();
                $jsonData["data"] = json_decode($slider);
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
