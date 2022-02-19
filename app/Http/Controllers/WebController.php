<?php

namespace App\Http\Controllers;

use App\Models\Site\Video;
use App\Models\Site\Slider;
use Illuminate\Support\Str;
use App\Models\Site\Comment;
use App\Models\Site\Message;
use Illuminate\Http\Request;
use App\Models\Education\Blog;
use App\Models\Education\Cour;
use App\Models\Parametre\Categorie;
use App\Models\Education\Enseignant;

class WebController extends Controller
{
    public function index(){
        $cours_en_vedettes = Cour::with('mode')->where([['en_vedette',1],['publier',1]])
                                    ->orderBy('date_publication','desc')->take(3)->get();

        $last_blogs = Blog::with('categorie')->where('publier',1)
                                    ->orderBy('created_at','desc')->take(3)->get();

        $enseignants = Enseignant::where('aff_sur_site',1)->orderBy('created_at','desc')->take(5)->get();
        $sliders = Slider::orderBy('created_at','desc')->take(4)->get();

        $videos = Video::orderBy('created_at','desc')->take(3)->get();

        return view('front-end.index',compact('cours_en_vedettes','last_blogs','enseignants','sliders','videos'));
    }

    public function about(){
        return view('front-end.about');
    }

    public function cours(){
        $cours = Cour::with('mode')->paginate(9);
        return view('front-end.cours',compact('cours'));
    }

    public function blogs(){
        $blogs = Blog::paginate(9);
        return view('front-end.blogs',compact('blogs'));
    }

    public function contact(){
        return view('front-end.contact');
    }

    public function cour(string $slug, int $id){
        $cour = Cour::with('mode')->where('cours.id',$id)->first();
        
        $cours_simmilaires = Cour::with('mode')->where([['categorie_id',$cour->categorie_id],['id','!=',$id]])->take(5)->get();

        $commentaires = Comment::where('cour_id',$id)->orderBy('created_at','desc')->get();

        return view('front-end.cours-details',compact('cour','cours_simmilaires','commentaires'));
    }

    public function blog(string $slug, int $id){
        $blog = Blog::findOrFail($id);
        $categorie = Categorie::findOrFail($blog->categorie_id);
        $blogs = Blog::with('categorie')->where('id','!=',$id)->take(5)->get();

        $commentaires = Comment::where('blog_id',$id)->orderBy('created_at','desc')->get();

        return view('front-end.blog-details',compact('blog','categorie','blogs','commentaires'));
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
}
