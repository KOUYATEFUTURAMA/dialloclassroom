<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Discution\Post;
use App\Models\Parametre\Theme;
use App\Models\Parametre\Centre;
use App\Models\Mediatheque\Media;
use App\Models\Participant\Jeune;
use App\Models\Mediatheque\Astuce;
use Illuminate\Support\Facades\DB;
use App\Models\Parametre\Specialite;
use Illuminate\Support\Facades\Auth;
use App\Models\Participant\Animateur;
use App\Models\Discution\Referencement;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin(){
       
        $menuPrincipal = "Accueil";
        $titleControlleur = "Tableau de bord";
        $btnModalAjout = "FALSE";

        return view('admin-dashboard', compact( 'menuPrincipal', 'titleControlleur', 'btnModalAjout'));
    }

    public function caissier() {
        
        
        $menuPrincipal = "Accueil";
        $titleControlleur = "Tableau de bord";
        $btnModalAjout = "FALSE";

        return view('caissier-dashboard', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
    }
}
