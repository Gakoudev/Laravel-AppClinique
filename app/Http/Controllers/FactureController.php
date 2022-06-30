<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FactureController extends Controller
{
    public static function new($id)
    {
        if (Session::has('user')) {
            $facture = Facture::create([
                'numero' => 'F001',
                'etat' => 1,
                'patient' => $id,
                'user' => Auth::user()->id,
                'date' => Carbon::now(),
            ]);
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
