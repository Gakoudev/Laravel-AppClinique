<?php

namespace App\Http\Controllers;

use App\Models\Ordonance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrdonanceController extends Controller
{
    public static function new($id)
    {
        if (Session::has('user')) {
            $facture = DB::table('factures')->where('patient','=',$id)
                                            ->where('etat','=',1)->get();
            if (!isset($facture)){
                $facture = FactureController::new($id);
            }
            $ordonance = Ordonance::create([
                'etat' => 1,
                'patient' => $id,
                'user' => Auth::user()->id,
                'facture'=>$facture[0]->id,
            ]);
            return $ordonance;
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
}
