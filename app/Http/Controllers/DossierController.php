<?php

namespace App\Http\Controllers;

use App\Models\Antecedent;
use App\Models\Facture;
use App\Models\Ordonance;
use App\Models\Patient;
use App\Models\Traitement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DossierController extends Controller
{  
    public function getDossier($id)
    {
        if (Session::has('user')) {
            $facture = Facture::where('patients_id','=',$id)
                                      ->where('etat','=',1)->get();
            if (!$facture->isEmpty()) {
                $patient = Patient::find($id);
                $antecedents = Antecedent::where('patients_id','=',$id)->get();
                $traitements = Traitement::where('factures_id','=',$facture[0]->id)->get();
                $ordonances = Ordonance::where('factures_id','=',$facture[0]->id)->get();
                $etat = $facture[0]->etat;
                if(Auth::user()->role->nom=='SECRETAIRE'){
                    $etat = 2;
                }
                return view('dossier.dossier',['traitements'=>$traitements,'ordonances'=>$ordonances,'patient'=>$patient,'antecedents'=>$antecedents,'etat'=>$etat]);
            }
            else {
                return redirect()->route('getAllDossier',['id'=>$id]);
                
            }
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
    
    public function getAllDossier($id)
    {
        if (Session::has('user')) {
            $patient = Patient::find($id);
            $dossiers = Facture::where('patients_id','=',$id)
                                            ->get();
            return view('dossier.alldossier',['patient'=>$patient,'dossiers'=>$dossiers]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
        
    }

    public function getDossierbyId($id)
    {
        if (Session::has('user')) {
            $dossier = Facture::find($id);
            $antecedents = Antecedent::where('patients_id','=',$id)->get();
            $patient = Patient::find($dossier->patients_id);
            $traitements = Traitement::where('factures_id','=',$dossier->id)->get();
            $ordonances = Ordonance::where('factures_id','=',$dossier->id)->get();
            $etat = $dossier->etat;
            if(Auth::user()->role->nom=='SECRETAIRE'){
                $etat = 2;
            }
            return view('dossier.dossier',['traitements'=>$traitements,'ordonances'=>$ordonances,'patient'=>$patient,'antecedents'=>$antecedents,'etat'=>$etat]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
        
    }
}
