<?php

namespace App\Http\Controllers;

use App\Models\Antecedent;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AtecedentController extends Controller
{
    public function getAllAntecedent($id)
    {
        if (Session::has('user')) {
            $antecedents = DB::table('antecedents')->where('patients_id','=',$id)->get();
            $patient = Patient::find($id);
            return view('antecedent.antecedent',['antecedents'=>$antecedents,'patient'=>$patient]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
    public function addAntecedent($id,Request $request)
    {
        if (Session::has('user')) {
            $request->validate([
                'libelle' => ['required', 'string', 'max:255'],
                'detail' => ['required', 'string', 'max:255'],
            ]);

            $antecedent = Antecedent::create([
                'libelle' => $request->libelle,
                'detail' => $request->detail,
                'patients_id' => $id,
            ]);
            return redirect()->route('listAntecedent',['id'=>$id]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
    
    public function deleteAntecedent($id)
    {
        if (Session::has('user')) {
            $antecedent=Antecedent::find($id);
            $pId = $antecedent->patients_id;
            $antecedent->delete($id);
            return redirect()->route('listAntecedent',['id'=>$pId]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
}
