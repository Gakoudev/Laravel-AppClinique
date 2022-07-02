<?php

namespace App\Http\Controllers;

use App\Models\Parametrage;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PatientController extends Controller
{
    public function getAll()
    {
        if (Session::has('user')) {
           
            $patients=Patient::all();
            return view('patient.patient',['patients'=>$patients]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
    
    public function getAllPatient()
    {
        if (Session::has('user')){
            $patients=Patient::all();
            return view('medecin.patient',['patients'=>$patients]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
    public function addPatient(Request $request)
    {
        if (Session::has('user')){
            
            $param = Parametrage::find(1);
            $request->validate([
                'prenom' => ['required', 'string', 'max:255'],
                'nom' => ['required', 'string', 'max:255'],
                'telephone' => ['required', 'string', 'max:255'],
                'dateN' => ['required', 'date'],
            ]);

            $patient = Patient::create([
                'numero' => 'P'.(string)$param->numPat,
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'telephone' => $request->telephone,
                'dateN' => $request->dateN,
                'users_id' => Auth::user()->id,
            ]);
            $param->numPat++;
            $param->save();
            return redirect()->route('listAntecedent',['id'=>$patient->id]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }

}
