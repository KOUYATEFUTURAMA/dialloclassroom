<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Site\Video;
use App\Models\Site\Slider;
use Illuminate\Support\Str;
use App\Models\Site\Comment;
use App\Models\Site\Message;
use Illuminate\Http\Request;
use App\Models\Education\Blog;
use App\Models\Education\Cour;
use Illuminate\Support\Carbon;
use App\Models\Education\Reservation;
use App\Models\Parametre\Categorie;
use App\Models\Education\Enseignant;

class WebController extends Controller
{
    
    
    public function index(){

        $cours_en_vedettes = Cour::with('mode')->where([['en_vedette',1],['publier',1]])
                                    ->orderBy('date_publication','desc')->take(3)->get();

        $last_blogs = Blog::with('categorie')->where('publier',1)
                                    ->orderBy('created_at','desc')->take(3)->get();

        $enseignants = Enseignant::where([['aff_sur_site',1],['image','!=',null]])->orderBy('created_at','desc')->get();
        $sliders = Slider::orderBy('created_at','desc')->take(4)->get();

        $videos = Video::orderBy('created_at','desc')->take(3)->get();

        return view('front-end.index',compact('cours_en_vedettes','last_blogs','enseignants','sliders','videos'));
    }

    public function about(){
        return view('front-end.about');
    }

    public function cours(){
        $cours = Cour::with('mode')->orderBy('created_at','desc')->paginate(9);
        return view('front-end.cours',compact('cours'));
    }

    public function blogs(){
        $blogs = Blog::orderBy('created_at','desc')->paginate(9);
        return view('front-end.blogs',compact('blogs'));
    }

    public function galeries(){
        $videos = Video::orderBy('created_at','desc')->paginate(9);
        return view('front-end.videos',compact('videos'));
    }

    public function contact(){
        return view('front-end.contact');
    }

    public function cour(string $slug, int $id){
        $cour = Cour::with('mode')->where('cours.id',$id)->first();
        
        $cours_simmilaires = Cour::with('mode')->where([['categorie_id',$cour->categorie_id],['id','!=',$id]])->orderBy('created_at','desc')->take(5)->get();

        $commentaires = Comment::where('cour_id',$id)->orderBy('created_at','desc')->get();

        return view('front-end.cours-details',compact('cour','cours_simmilaires','commentaires'));
    }

    public function blog(string $slug, int $id){
        $blog = Blog::findOrFail($id);
        $categorie = Categorie::findOrFail($blog->categorie_id);
        $blogs = Blog::with('categorie')->where('id','!=',$id)->orderBy('created_at','desc')->take(5)->get();

        $commentaires = Comment::where('blog_id',$id)->orderBy('created_at','desc')->get();

        return view('front-end.blog-details',compact('blog','categorie','blogs','commentaires'));
    }

    public function achatCour(string $slug, int $id){
        $cour = Cour::findOrFail($id);
        return view('front-end.achat-cours',compact('cour'));
    }

    public function login(){
        return view('front-end.site-login');
    }

    public function register(){
        return view('front-end.site-register');
    }

    public function commentStore(Request $request){
        
        $this->validate($request,
            [
                'name' => 'required|string',
                'contact' => 'required|string',
                'content' => 'required',
            ]
        );

        $data = $request->all();

        if(isset($data['cour_id'])){
            $cour = Cour::find($data['cour_id']);
        }
        if(isset($data['blog_id'])){
            $blog = Blog::find($data['blog_id']);
        }

        $comment = new Comment();
        $comment->name = $data['name'];
        $comment->contact = $data['contact'];
        $comment->cour_id = isset($data['cour_id']) ? $cour->id : null;
        $comment->blog_id = isset($data['blog_id']) ? $blog->id : null;
        $comment->content = $data['content'];
        $comment->save();

        if(isset($data['cour_id'])){
            return redirect()->route('web.cours-details', ['slug' => Str::slug($cour->libelle_cours), 'id' => $cour->id]);
        }

        if(isset($data['blog_id'])){
            return redirect()->route('web.blog-details', ['slug' => Str::slug($blog->titre_blog), 'id' => $blog->id]);
        }
    }
    public function messageStore(Request $request){
     
        $this->validate($request,
            [
                'name' => 'required|string',
                'sujet' => 'required|string',
                'email' => 'required',
                'contact' => 'required',
                'message' => 'required',
            ]
        );

        $data = $request->all();
        
        $message = new Message();
        $message->name = $data['name'];
        $message->sujet = $data['sujet'];
        $message->email = $data['email'];
        $message->contact = $data['contact'];
        $message->message = $data['message'];
        $message->save();

        return redirect()->route('web.contact')->with("message","Message envoyé avec succès");
    }

    public function retourPayementSuccess(Request $request){
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];
        if ($request->isMethod('post') && $request->input('cours_id')) {

                $data = $request->all();

            try {
                
                $reservation = new Reservation();
                $reservation->cours_id = $data['cours_id'];
                $reservation->amount = $data['amount'];
                $reservation->payment_method = $data['payment_method'];
                $reservation->description = $data['description'];
                $reservation->operator_id = 88888;
                $reservation->payment_date = Carbon::createFromFormat('Y-m-d H:i:s', $data['payment_date']);
                if($data['mode'] != "cours-video"){
                    $reservation->contact_costumer = $data['contact'];
                    $reservation->name_costumer = $data['name'];
                    $reservation->email_costumer = $data['email'];
                }
                $reservation->save();

                //Création d'un lien de téléchargement pour envoyer a l'user par mail
                if($reservation && $data['mode'] == "cours-video"){
                    $cours = Cour::find($reservation->cours_id);
                    $jsonData['link'] = $cours->video_cours;
                }
                $jsonData['mode'] = $data['mode'];
                
                $jsonData["data"] = json_decode($reservation);
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
}
