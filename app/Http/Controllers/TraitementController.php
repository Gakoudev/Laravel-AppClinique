<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Traitement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TraitementController extends Controller
{
    public function getAll($id)
    {
        $traitements = DB::table('traitements')->where('patient','=',$id)->get();
        $patient = Patient::find($id);
        return view('traitement.traitement',['traitements'=>$traitements,'patient'=>$patient]);
    }
    
    public function getActive($id)
    {
        $patient = Patient::find($id);
        $facture = DB::table('factures')->where('patient','=',$id)
                                        ->where('etat','=',1)->get();
        if (isset($facture)) {
            $traitements = DB::table('traitements')->where('facture','=',$facture[0]->id)->get();
            return view('traitement.traitement',['traitements'=>$traitements,'patient'=>$patient]);
        }
        else {
            return view('traitement.traitement',['patient'=>$patient]);
            
        }
    }

    public function add($id,Request $request)
    {
        $facture = DB::table('factures')->where('patient','=',$id)
                                               ->where('etat','=',1)->get();
        if(!isset($facture))
        {
            $facture = FactureController::new($id);
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
            'patient' => $id,
            'user' => Auth::user()->id,
            'facture'=>$facture[0]->id,
        ]);
        return redirect()->route('listTraitement',['id'=>$id]);
    }
    
}
