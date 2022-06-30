<?php

namespace App\Http\Controllers;

use App\Models\Ordonance;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    public function getByOrdonance($id)
    {
        $prescriptions = DB::table('prescriptions')->where('ordonance','=',$id)->get();
        $ordonance = Ordonance::find($id);
        $patient = Patient::find($ordonance->patient);
        $etat=0;
        return view('ordonance.ordonance',['prescriptions'=>$prescriptions,'patient'=>$patient,'etat'=>$etat]);
    }
    
    public function getActive($id)
    {
        $patient = Patient::find($id);
        $ordonance = DB::table('ordonances')->where('patient','=',$id)
                                        ->where('etat','=',1)->get();
        if (!$ordonance->isEmpty()) {
            $prescriptions = DB::table('prescriptions')->where('ordonance','=',$ordonance[0]->id)->get();
            $etat=1;
            return view('ordonance.ordonance',['prescriptions'=>$prescriptions,'patient'=>$patient,'etat'=>$etat]);
        }
        else {
            $etat=1;
            return view('ordonance.ordonance',['patient'=>$patient,'etat'=>$etat]);
            
        }
    }

    public function add($id,Request $request)
    {
        $ordonances = DB::table('ordonances')->where('patient','=',$id)
                                               ->where('etat','=',1)->get();
        if($ordonances->isEmpty())
        {
            $ordonance = OrdonanceController::new($id);
        } 
        else{
            $ordonance = $ordonances[0];
        }
        $request->validate([
            'libelle' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string', 'max:255'],
            'quantite' => ['required', 'string', 'max:255'],
        ]);

        $prescription = Prescription::create([
            'libelle' => $request->libelle,
            'quantite' => $request->quantite,
            'detail' => $request->detail,
            'ordonance'=>$ordonance->id,
        ]);
        return redirect()->route('listPrescription',['id'=>$id]);
    }
    
    public function delete($id)
    {
        $prescription=Prescription::find($id);
        $ordonance = Ordonance::find($prescription->ordonance);
        $pId = $ordonance->patient;
        $prescription->delete($id);
        return redirect()->route('listPrescription',['id'=>$pId]);
    }
}
