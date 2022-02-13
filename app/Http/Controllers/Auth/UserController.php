<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index(){
      
        $menuPrincipal = "Auth";
        $titleControlleur = "Liste des utilisateurs";
        $btnModalAjout = (Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur") ? "TRUE" : "FALSE";

        if(Auth::user()->role =="Concepteur" or Auth::user()->role =="Administrateur"){
            return view('auth.user.index', compact('btnModalAjout', 'menuPrincipal', 'titleControlleur'));
        }else{
            return abort(404);
        }
    }

    public function profil(){
        $user = User::where('users.id', Auth::user()->id)
                    ->select('users.*',DB::raw('DATE_FORMAT(last_login_at, "%d-%m-%Y à %H:%i:%s") as last_login'),DB::raw('DATE_FORMAT(users.created_at, "%d-%m-%Y à %H:%i") as created'))
                    ->first();

        $menuPrincipal = "Auth";
        $titleControlleur = "Profil utilisateur";
        $btnModalAjout = "FALSE";
        return view('auth.user.profil', compact('user','btnModalAjout', 'menuPrincipal', 'titleControlleur'));
    }

    public function listeUser(){
        $users = User::select('users.*',DB::raw('DATE_FORMAT(last_login_at, "%d-%m-%Y à %H:%i:%s") as last_login'),DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y à %H:%i") as created'))
                ->where('role','!=','Concepteur')
                ->orderBy('name','asc')
                ->get();

        $jsonData["rows"] = $users->toArray();
        $jsonData["total"] = $users->count();
        return response()->json($jsonData);
    }

    public function action(Request $request){
        $jsonData = ["code" => 1, "msg" => "Enregistrement effectué avec succès."];

        if ($request->isMethod('post') && $request->input('name')) {
            $data = $request->all();

            try {
                
                $user = $data['id'] ? User::find($data['id']) : new User();
                
                //verification du dubblon sur l'email
                if(isset($data['email'])){
                   $doublonEmail = User::where([['email',$data['email']],['id','!=',$user->id]])->first();
                    if($doublonEmail){
                        return response()->json(["code" => 0, "msg" => " L'email que vous avez choisi existe !", "data" => NULL]);
                    } 
                }
              
                $user->name = $data['name'];
                $user->role = $data['role'];
                $user->contact = $data['contact'];
                $user->statut_compte = isset($data['statut_compte']) ? TRUE : FALSE;
                $user->password = bcrypt($data['password']);
                if(empty($data['id']) or ($user->email != $data['email'])){
                    //noouvel enregistrement
                    $user->confirmation_token = str_replace('/', '', bcrypt(Str::random(16)));
                }
                $user->email = $data['email'];
                $user->save();

                $jsonData["data"] = json_decode($user);
                return response()->json($jsonData);
            }catch(Exception $exc) {
                $jsonData["code"] = -1;
                $jsonData["data"] = NULL;
                $jsonData["msg"] = $exc->getMessage();
                return response()->json($jsonData);
            }
        }
        return response()->json(["code" => 0, "msg" => "Saisie invalide", "data" => NULL]);
    }

    public function updateProfil(Request $request, int $user){
        $user = User::find($user);
        $data = $request->all();

        $jsonData = ["code" => 1, "msg" => "Modification effectuée avec succès."];

        if($user){

            try {
                    //login ou l'email doit exister
                    if(!isset($data['email'])){
                        return response()->json(["code" => 0, "msg" => " Veillez definir un email !", "data" => NULL]);
                    }
                    //verification du dubblon sur le login et l'email
                    $doublon = User::where([['email',$data['email']],['id','!=',$user->id]])->first();
                    if($doublon){
                        return response()->json(["code" => 0, "msg" => " L'email que vous avez choisi existe !", "data" => NULL]);
                    }

                    $user->name = $data['name'];
                    $user->email = isset($data['email']); 
                    $user->contact = $data['contact'];
                    $user->save();

                $jsonData["data"] = json_decode($user);
            return response()->json($jsonData);

            } catch (Exception $exc) {
               $jsonData["code"] = -1;
               $jsonData["data"] = NULL;
               $jsonData["msg"] = $exc->getMessage();
               return response()->json($jsonData);
            }
        }
        return response()->json(["code" => 0, "msg" => "Utilisateur introuvable !", "data" => NULL]);
    }

    public function updatePassword(Request $request, int $user){
        $user = User::find($user);
        $data = $request->all();

        $jsonData = ["code" => 1, "msg" => "Modification effectuée avec succès."];

        if($user){

            try {
                  //Control du mot de passe actuelle
                    $credentials = request(['email', 'password']);
                    if (!Auth::attempt($credentials)) {
                        return response()->json(["code" => 0, "msg" => "Votre ancien mot de passe est incorrect.", "data" => NULL]);
                    }

                    //Control du format et l'égalité des deux de mot de passe
                    if($data['new_password'] != $data['repeat_password']){
                        return response()->json(["code" => 0, "msg" => "Il y a inconformité entre le nouveau mot de passe et la confirmation du mot de passe.", "data" => NULL]);
                    }

                    $user->password = bcrypt($data['new_password']);
                    $user->save();

                $jsonData["data"] = json_decode($user);
            return response()->json($jsonData);

            } catch (Exception $exc) {
               $jsonData["code"] = -1;
               $jsonData["data"] = NULL;
               $jsonData["msg"] = $exc->getMessage();
               return response()->json($jsonData);
            }
        }
        return response()->json(["code" => 0, "msg" => "Utilisateur introuvable !", "data" => NULL]);
    }

    public function delete($id)
    {
        $jsonData = ["code" => 1, "msg" => "Opération effectuée avec succès."];
        $user = User::find($id);
        if($user){
            try {

                $user->delete();
                $jsonData["data"] = json_decode($user);
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
