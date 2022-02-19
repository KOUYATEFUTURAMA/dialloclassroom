<?php

namespace App\Http\Controllers\Education;

use Image;
use Exception;
use Illuminate\Http\Request;
use App\Models\Education\Blog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')->where('blog',1)->select('id','libelle_categorie')->orderBy('libelle_categorie', 'ASC')->get();

        $menuPrincipal = "Education";
        $titleControlleur = "Liste des cours";
        $btnModalAjout = (Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur") ? "TRUE" : "FALSE";

        if(Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur"){
            return view('education.blog.index', compact('categories','menuPrincipal', 'titleControlleur', 'btnModalAjout'));
        }else{
            return abort(404);
        }
    }

    public function listeBlog(string $titre=NULL){
        if($titre){
            $blogs = Blog::with('categorie')
                        ->select('blogs.*',DB::raw('DATE_FORMAT(date_event, "%d-%m-%Y") as date_events'))
                        ->where('titre_blog','like', '%' . $titre . '%')
                        ->orderBy('created_at', 'DESC')
                        ->get();
        }else{
            $blogs = Blog::with('categorie')
                        ->select('blogs.*',DB::raw('DATE_FORMAT(date_event, "%d-%m-%Y") as date_events'))
                        ->orderBy('created_at', 'DESC')
                        ->get();
        }

       $jsonData["rows"] = $blogs->toArray();
       $jsonData["total"] = $blogs->count();
       return response()->json($jsonData);
    }

    public function listeBlogByCategorie($categorie){
      
        $blogs = Blog::with('categorie')
                        ->select('blogs.*',DB::raw('DATE_FORMAT(date_event, "%d-%m-%Y") as date_events'))
                        ->where('categorie_id',$categorie)
                        ->orderBy('created_at', 'DESC')
                        ->get();
       
       $jsonData["rows"] = $blogs->toArray();
       $jsonData["total"] = $blogs->count();
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
        if ($request->isMethod('post') && $request->input('titre_blog')) {

                $data = $request->all();

            try {

                $blog = $data['id'] ? Blog::findOrFail($data['id']) : new Blog;

                $blog->titre_blog = $data['titre_blog'];
                $blog->categorie_id = $data['categorie_id'];
                $blog->content = $data['content'];
                $blog->publier = isset($data['publier']) ? TRUE : FALSE;
                $blog->date_event = Carbon::createFromFormat('d-m-Y', $data['date_event']);

                if(isset($data['image'])){
                    $file_name = 'blog'.date('dmYHis').'.jpg';
                    $img = Image::make($data['image']);
                    $image_detail = Image::make($data['image']);

                    $img->save(storage_path('app/public/img/blog/'.$file_name),60);
                    $blog->image = '/storage/img/blog/'.$file_name;

                    $image_detail->save(storage_path('app/public/img/blog/image_detail'.$file_name),60);
                    $blog->image_detail = '/storage/img/blog/image_detail'.$file_name;
                }

                $blog->save();
                $jsonData["data"] = json_decode($blog);
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
        $blog = Blog::find($id);

        $jsonData = ["code" => 1, "msg" => " Opération effectuée avec succès."];
            if($blog){
                try {
                //Suppression dans les dossiers lié a l'enregistrement
                if($blog->image){
                    unlink(public_path().$blog->image);
                }
                $blog->delete();
                $jsonData["data"] = json_decode($blog);
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

    public function ckeditorUpload(Request $request)
    {

        if ($request->hasFile('file'))
        {

            $image = $request->file('file');

            $file_extention = strtolower($image->getClientOriginalExtension());
            $file_name = 'image_ckeditor_'.date("dmYHis").'.'. $file_extention;
            $img  = Image::make($request->file('file')->getRealPath());
            $img->resize(800, 500);
            $img->save(storage_path('app/public/img/ckeditor/'.$file_name),40);

            return response()->json(["uploaded" => true, "url" => asset('storage/img/ckeditor/'.$file_name)]);
        }
    }
}
