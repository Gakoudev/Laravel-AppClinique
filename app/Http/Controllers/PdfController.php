<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Ordonance;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfController extends Controller
{

    public function ordonancePDF($id){
      $prescriptions =  DB::table('prescriptions')->where('ordonances_id','=',$id)->get();
        $ordonance = Ordonance::find($id);
        $doc = User::find($ordonance->users_id);
        $patient = Patient::find($ordonance->patients_id);
      $pdf = PDF::loadView('pdf.pdfordonance',['prescriptions'=> $prescriptions,'doc'=> $doc,'patient'=> $patient])->setPaper('a5');
      $ordonance->etat = 0;
      $ordonance->save();
      return $pdf->download('ordonnance.pdf');

    }

    public function facturePDF($id){
      $traitements =  DB::table('traitements')->where('factures_id','=',$id)->get();
        $facture = Facture::find($id);
        $facture->user = Auth::user()->id;
        $sec = User::find($facture->users_id);
        $patient = Patient::find($facture->patients_id);
        $total = 0;
      $pdf = PDF::loadView('pdf.pdffacture',['total'=> $total,'traitements'=> $traitements,'sec'=> $sec,'patient'=> $patient,'facture'=> $facture])->setPaper('a4', 'landscape');
      $facture->etat = 0;
      $facture->save();
      return $pdf->download('facture.pdf');

    }
}
