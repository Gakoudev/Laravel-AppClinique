<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RendezvousController extends Controller
{
    public function getAllRendezvous($id)
    {
        if (Session::has('user')) {
            $rendezvous = DB::table('rendezvouses')->where('patient','=',$id)->get();
            $patient = Patient::find($id);
            return view('rendezvous.rendezvous',['rendezvous'=>$rendezvous,'patient'=>$patient]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
    
    public function getActiveRV($id)
    {
        if (Session::has('user')) {
            $rendezvous = DB::table('rendezvouses')->where('patient','=',$id)
                                                ->where('etat','=',1)->get();
            $patient = Patient::find($id);
            return view('rendezvous.rendezvous',['rendezvous'=>$rendezvous,'patient'=>$patient,'update'=>0]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
    public function addRV($id,Request $request)
    {
        if (Session::has('user')) {
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
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
    
    public function decalerRV($id)
    {
        if (Session::has('user')) {
            $rendezvous=Rendezvous::find($id);
            $patient = Patient::find($rendezvous->patient);
            return view('rendezvous.rendezvous',['rendezvous'=>$rendezvous,'patient'=>$patient,'update'=>1]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }

    
    public function updateRV($id,Request $request)
    {
        if (Session::has('user')) {
            $request->validate([
                'dateRV' => ['required', 'date'],
                'detail' => ['required', 'string', 'max:255'],
            ]);

            $rendezvous=Rendezvous::find($id);
            $rendezvous->detail =  $request->detail;
            $rendezvous->dateRv =  $request->dateRV;
            $pId = $rendezvous->patient;
            $rendezvous->save();
            return redirect()->route('activeRV',['id'=>$pId]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }

    public function finRV($id)
    {
        if (Session::has('user')) {
            $rendezvous=Rendezvous::find($id);
            $pId = $rendezvous->patient;
            $rendezvous->etat=1-$rendezvous->etat;
            $rendezvous->save();
            return redirect()->route('activeRV',['id'=>$pId]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
}
