<?php

namespace App\Http\Controllers;

use App\Models\Antecedent;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtecedentController extends Controller
{
    public function getAllAntecedent($id)
    {
        // $antecedents = Antecedent::where('patient','=',$id);
        $antecedents = DB::table('antecedents')->where('patient','=',$id)->get();
        $patient = Patient::find($id);
        // $patient = Patient::find($id);
        return view('antecedent.antecedent',['antecedents'=>$antecedents,'patient'=>$patient]);
    }
    public function addAntecedent($id,Request $request)
    {
        $request->validate([
            'libelle' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string', 'max:255'],
        ]);

        $antecedent = Antecedent::create([
            'libelle' => $request->libelle,
            'detail' => $request->detail,
            'patient' => $id,
        ]);
        return redirect()->route('listAntecedent',['id'=>$id]);
    }
    
    public function deleteAntecedent($id)
    {
        $antecedent=Antecedent::find($id);
        $pId = $antecedent->patient;
        $antecedent->delete($id);
        return redirect()->route('listAntecedent',['id'=>$pId]);
    }
}
