<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Traitement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TraitementController extends Controller
{
    public function getAll($id)
    {
        if (Session::has('user')) {
            $traitements = Traitement::where('patients_id','=',$id)->get();
            $patient = Patient::find($id);
            return view('traitement.traitement',['traitements'=>$traitements,'patient'=>$patient]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
    
    public function getActive($id)
    {
        if (Session::has('user')) {
            $patient = Patient::find($id);
            $facture = DB::table('factures')->where('patients_id','=',$id)
                                            ->where('etat','=',1)->get();
            if (!$facture->isEmpty()) {
                $traitements = Traitement::where('factures_id','=',$facture[0]->id)->get();
                return view('traitement.traitement',['traitements'=>$traitements,'patient'=>$patient]);
            }
            else {
                return view('traitement.traitement',['patient'=>$patient]);
                
            }
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }

    public function add($id,Request $request)
    {
        if (Session::has('user')) {
            $facture = DB::table('factures')->where('patients_id','=',$id)
                                                ->where('etat','=',1)->get();

            if($facture->isEmpty())
            {
                $facture = FactureController::new($id);
                $idfac = $facture->id;
            } 
            else{
                
                $idfac = $facture[0]->id;
            }
            $request->validate([
                'libelle' => ['required', 'string', 'max:255'],
                'date' => ['required', 'date'],
                'detail' => ['required', 'string', 'max:255'],
                'prix' => ['required', 'numeric'],
            ]);

            $traitement = Traitement::create([
                'libelle' => $request->libelle,
                'date' => $request->date,
                'detail' => $request->detail,
                'prix' => $request->prix,
                'patients_id' => $id,
                'users_id' => Auth::user()->id,
                'factures_id'=>$idfac,
            ]);
            return redirect()->route('listTraitement',['id'=>$id]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
    
}
