<?php

namespace App\Http\Controllers;

use App\Models\Site\Video;
use App\Models\Education\Blog;
use App\Models\Education\Cour;
use Illuminate\Support\Facades\DB;
use App\Models\Education\Enseignant;
use App\Models\Education\Reservation;

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
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);
        $ca_acht_jour = 0;
        $ca_reser_jour = 0;
        $ca_acht_week = 0;
        $ca_reser_week = 0;
        $ca_acht_mois = 0;
        $ca_reser_mois = 0;
        $ca_acht_total = 0;
        $ca_reser_total = 0;

        $blogs = Blog::all();
        $cours = Cour::all();
        $enseignants = Enseignant::all();
        $videos = Video::all();

        $coursAchats = Reservation::join('cours','cours.id','reservations.cours_id')
                                ->join('modes','modes.id','cours.mode_id')
                                ->select('cours.libelle_cours',DB::raw('count(reservations.cours_id) as total'))
                                ->where('modes.slug','cours-video')
                                ->groupBy('reservations.cours_id')
                                ->orderBy('total', 'desc')->take(5)->get();

        $coursReserves = Reservation::join('cours','cours.id','reservations.cours_id')
                                ->join('modes','modes.id','cours.mode_id')
                                ->select('cours.libelle_cours',DB::raw('count(reservations.cours_id) as total'))
                                ->where('modes.slug','!=','cours-video')
                                ->groupBy('reservations.cours_id')
                                ->orderBy('total', 'desc')->take(5)->get();

        $caAchtJours = Reservation::join('cours','cours.id','reservations.cours_id')
                                    ->join('modes','modes.id','cours.mode_id')
                                    ->whereDate('payment_date',date("Y-m-d"))
                                ->where('modes.slug','cours-video')
                                ->get(); 
        foreach ($caAchtJours as $caJour) {
            $ca_acht_jour += $caJour->amount;
        }

        $caReservJours = Reservation::join('cours','cours.id','reservations.cours_id')
                                ->join('modes','modes.id','cours.mode_id')
                                ->whereDate('payment_date',date("Y-m-d"))
                                ->where('modes.slug','!=','cours-video')
                                ->get(); 
        foreach ($caReservJours as $caJour) {
            $ca_reser_jour += $caJour->amount;
        }

        $caAchtWeeks = Reservation::join('cours','cours.id','reservations.cours_id')
                                ->join('modes','modes.id','cours.mode_id')
                                ->whereBetween('payment_date', [$start_week, $end_week])
                                ->where('modes.slug','cours-video')
                                ->get(); 

        foreach ($caAchtWeeks as $caWeek) {
            $ca_acht_week += $caWeek->amount;
        }

        $caReserWeeks = Reservation::join('cours','cours.id','reservations.cours_id')
                                ->join('modes','modes.id','cours.mode_id')
                                ->whereBetween('payment_date', [$start_week, $end_week])
                                ->where('modes.slug','!=','cours-video')
                                ->get(); 

        foreach ($caReserWeeks as $caWeek) {
            $ca_reser_week += $caWeek->amount;
        }

        $caAchtMois = Reservation::join('cours','cours.id','reservations.cours_id')
                                ->join('modes','modes.id','cours.mode_id')
                                ->whereMonth('payment_date',date('m'))
                                ->where('modes.slug','cours-video')
                                ->get(); 

        foreach ($caAchtMois as $caMoi) {
            $ca_acht_mois += $caMoi->amount;
        }

        $caReserMois = Reservation::join('cours','cours.id','reservations.cours_id')
                                ->join('modes','modes.id','cours.mode_id')
                                ->whereMonth('payment_date',date('m'))
                                ->where('modes.slug','!=','cours-video')
                                ->get(); 

        foreach ($caReserMois as $caMoi) {
            $ca_reser_mois += $caMoi->amount;
        }

        $caAchtTotal = Reservation::join('cours','cours.id','reservations.cours_id')
                                ->join('modes','modes.id','cours.mode_id')
                                ->where('modes.slug','cours-video')->get();
        foreach ($caAchtTotal as $ca) {
            $ca_acht_total += $ca->amount;
        }

        $caReserTotal = Reservation::join('cours','cours.id','reservations.cours_id')
                                    ->join('modes','modes.id','cours.mode_id')
                                    ->where('modes.slug','!=','cours-video')->get();
        foreach ($caReserTotal as $ca) {
            $ca_reser_total += $ca->amount;
        }

        $menuPrincipal = "Accueil";
        $titleControlleur = "Tableau de bord";
        $btnModalAjout = "FALSE";

        return view('admin-dashboard', compact('blogs','cours','enseignants','videos','coursAchats','coursReserves','ca_acht_jour','ca_reser_jour','ca_acht_week','ca_reser_week','ca_acht_mois','ca_reser_mois','ca_acht_total','ca_reser_total','menuPrincipal', 'titleControlleur', 'btnModalAjout'));
    }

    public function caissier() {
        
        
        $menuPrincipal = "Accueil";
        $titleControlleur = "Tableau de bord";
        $btnModalAjout = "FALSE";

        return view('caissier-dashboard', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
    }
}
