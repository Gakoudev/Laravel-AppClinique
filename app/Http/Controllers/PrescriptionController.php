<?php

namespace App\Http\Controllers;

use App\Models\Ordonance;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PrescriptionController extends Controller
{
    public function getByOrdonance($id)
    {
        if (Session::has('user')) {
            $prescriptions = Prescription::where('ordonances_id','=',$id)->get();
            $ordonance = Ordonance::find($id);
            $patient = Patient::find($ordonance->patients_id);
            $etat=0;
            return view('ordonance.ordonance',['prescriptions'=>$prescriptions,'patient'=>$patient,'etat'=>$etat]);
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
            $ordonance = Ordonance::where('patients_id','=',$id)
                                         ->where('etat','=',1)->get();
            if (!$ordonance->isEmpty()) {
                $prescriptions = Prescription::where('ordonances_id','=',$ordonance[0]->id)->get();
                $etat=1;
                return view('ordonance.ordonance',['prescriptions'=>$prescriptions,'patient'=>$patient,'etat'=>$etat]);
            }
            else {
                $etat=1;
                return view('ordonance.ordonance',['patient'=>$patient,'etat'=>$etat]);
                
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
            $ordonances = Ordonance::where('patients_id','=',$id)
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
                'ordonances_id'=>$ordonance->id,
            ]);
            return redirect()->route('listPrescription',['id'=>$id]);
        }
       else {
           Auth::guard('web')->logout();
           return redirect('/');
       }
    }
    
    public function delete($id)
    {
        if (Session::has('user')) {
            $prescription=Prescription::find($id);
            $ordonance = Ordonance::find($prescription->ordonance);
            $pId = $ordonance->patient;
            $prescription->delete($id);
            return redirect()->route('listPrescription',['id'=>$pId]);
        }
       else {
           Auth::guard('web')->logout();
           return redirect('/');
       }
    }
}
