<?php

namespace App\Http\Controllers\Education;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Education\Reservation;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuPrincipal = "Education";
        $titleControlleur = "Liste des réservation";
        $btnModalAjout = "FALSE";

        return view('education.reservation.index', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
    }

    public function achatVue(){
        $menuPrincipal = "Education";
        $titleControlleur = "Liste des cours achétés";
        $btnModalAjout = "FALSE";
        return view('education.reservation.achat', compact('menuPrincipal', 'titleControlleur', 'btnModalAjout'));
    }

    public function listeReservation(){
        $reservations = Reservation::with('cours')
                        ->join('cours','cours.id','reservations.cours_id')
                        ->join('modes','modes.id','cours.mode_id')
                        ->select('reservations.*',DB::raw('DATE_FORMAT(payment_date, "%d-%m-%Y %H:%i") as payment_dates'))
                        ->where('modes.slug','!=','cours-video')
                        ->orderBy('created_at', 'DESC')
                        ->get();

       $jsonData["rows"] = $reservations->toArray();
       $jsonData["total"] = $reservations->count();
       return response()->json($jsonData);
    }

    public function listeAchat(){
        $reservations = Reservation::with('cours')
                        ->join('cours','cours.id','reservations.cours_id')
                        ->join('modes','modes.id','cours.mode_id')
                        ->join('categories','categories.id','cours.categorie_id')
                        ->select('reservations.*','categories.libelle_categorie',DB::raw('DATE_FORMAT(payment_date, "%d-%m-%Y %H:%i") as payment_dates'))
                        ->where('modes.slug','cours-video')
                        ->orderBy('created_at', 'DESC')
                        ->get();

       $jsonData["rows"] = $reservations->toArray();
       $jsonData["total"] = $reservations->count();
       return response()->json($jsonData);
    }
}
