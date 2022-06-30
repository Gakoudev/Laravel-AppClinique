<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DossierController extends Controller
{  
    public function getDossier($id)
    {
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
    
    public function getAllDossier($id)
    {
        $patient = Patient::find($id);
        $dossiers = DB::table('factures')->where('patient','=',$id)
                                        ->get();
        return view('dossier.alldossier',['patient'=>$patient,'dossiers'=>$dossiers]);
        
    }

    public function getDossierbyId($id)
    {
        $dossier = Facture::find($id);
        $antecedents = DB::table('antecedents')->where('patient','=',$id)->get();
        $patient = Patient::find($dossier->patient);
        $traitements = DB::table('traitements')->where('facture','=',$dossier->id)->get();
        $ordonances = DB::table('ordonances')->where('facture','=',$dossier->id)->get();
        $etat = $dossier->etat;
        return view('dossier.dossier',['traitements'=>$traitements,'ordonances'=>$ordonances,'patient'=>$patient,'antecedents'=>$antecedents,'etat'=>$etat]);
        
    }
}
