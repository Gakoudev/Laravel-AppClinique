<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DossierController extends Controller
{  
    public function getDossier($id)
    {
        if (Session::has('user')) {
            $facture = DB::table('factures')->where('patient','=',$id)
                                            ->where('etat','=',1)->get();
            if (!$facture->isEmpty()) {
                $patient = Patient::find($id);
                $antecedents = DB::table('antecedents')->where('patient','=',$id)->get();
                $traitements = DB::table('traitements')->where('facture','=',$facture[0]->id)->get();
                $ordonances = DB::table('ordonances')->where('facture','=',$facture[0]->id)->get();
                $etat = $facture[0]->etat;
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
            $dossiers = DB::table('factures')->where('patient','=',$id)
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
            $antecedents = DB::table('antecedents')->where('patient','=',$id)->get();
            $patient = Patient::find($dossier->patient);
            $traitements = DB::table('traitements')->where('facture','=',$dossier->id)->get();
            $ordonances = DB::table('ordonances')->where('facture','=',$dossier->id)->get();
            $etat = $dossier->etat;
            return view('dossier.dossier',['traitements'=>$traitements,'ordonances'=>$ordonances,'patient'=>$patient,'antecedents'=>$antecedents,'etat'=>$etat]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
        
    }
}
