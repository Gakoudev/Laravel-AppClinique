<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FactureController extends Controller
{
    public static function new($id)
    {
        
        $facture = Facture::create([
            'numero' => 'F001',
            'etat' => 1,
            'patient' => $id,
            'user' => Auth::user()->id,
            'date' => Carbon::now(),
        ]);
        return $facture;
    }

    
    public function update($id,Request $request)
    {
        
        $facture = Facture::find($id);
        $facture->etat = 0;
        $facture->user = Auth::user()->id;
        $facture->save();
    }
}
