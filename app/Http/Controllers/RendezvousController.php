<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RendezvousController extends Controller
{
    public function getAllRendezvous($id)
    {
        // $antecedents = Antecedent::where('patient','=',$id);
        $rendezvous = DB::table('rendezvouses')->where('patient','=',$id)->get();
        $patient = Patient::find($id);
        return view('rendezvous.rendezvous',['rendezvous'=>$rendezvous,'patient'=>$patient]);
    }
    
    public function getActiveRV($id)
    {
        // $antecedents = Antecedent::where('patient','=',$id);
        $rendezvous = DB::table('rendezvouses')->where('patient','=',$id)
                                               ->where('etat','=',1)->get();
        $patient = Patient::find($id);
        return view('rendezvous.rendezvous',['rendezvous'=>$rendezvous,'patient'=>$patient,'update'=>0]);
    }
    public function addRV($id,Request $request)
    {
        $request->validate([
            'dateRV' => ['required', 'date'],
            'detail' => ['required', 'string', 'max:255'],
        ]);

        $rv = Rendezvous::create([
            'dateRV' => $request->dateRV,
            'detail' => $request->detail,
            'etat' => 1,
            'patient' => $id,
            'user' => Auth::user()->id,
        ]);
        return redirect()->route('activeRV',['id'=>$id]);
    }
    
    public function decalerRV($id)
    {
        $rendezvous=Rendezvous::find($id);
        $patient = Patient::find($rendezvous->patient);
        return view('rendezvous.rendezvous',['rendezvous'=>$rendezvous,'patient'=>$patient,'update'=>1]);
    }

    
    public function updateRV($id)
    {
        $rendezvous=Rendezvous::find($id);
        $pId = $rendezvous->patient;
        $rendezvous->save();
        return redirect()->route('activeRV',['id'=>$pId]);
    }
    public function finRV($id)
    {
        $rendezvous=Rendezvous::find($id);
        $pId = $rendezvous->patient;
        $rendezvous->etat=1-$rendezvous->etat;
        $rendezvous->save();
        return redirect()->route('activeRV',['id'=>$pId]);
    }
}
