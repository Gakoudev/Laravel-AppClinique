<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function getAll()
    {
        $patients=Patient::all();
        return view('patient.patient',['patients'=>$patients]);
    }
    
    public function getAllPatient()
    {
        $patients=Patient::all();
        return view('medecin.patient',['patients'=>$patients]);
    }
    public function addPatient(Request $request)
    {
        $request->validate([
            'numero' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'dateN' => ['required', 'date'],
        ]);

        $patient = Patient::create([
            'numero' => $request->numero,
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'dateN' => $request->dateN,
            'user' => Auth::user()->id,
        ]);
        return redirect()->route('listAntecedent',['id'=>$patient->id]);
    }

}
