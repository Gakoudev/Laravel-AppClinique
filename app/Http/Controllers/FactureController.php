<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Parametrage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FactureController extends Controller
{
    public static function new($id)
    {
        if (Session::has('user')) {
            $param = Parametrage::find(1);
            $facture = Facture::create([
                'numero' => 'F'.(string)$param->numFac,
                'etat' => 1,
                'patients_id' => $id,
                'users_id' => Auth::user()->id,
                'date' => Carbon::now(),
            ]);
            $param->numFac++;
            $param->save();
            return $facture;
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }

    
    public function update($id,Request $request)
    {
        if (Session::has('user')) {
            $facture = Facture::find($id);
            $facture->etat = 0;
            $facture->user = Auth::user()->id;
            $facture->save();
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
}
