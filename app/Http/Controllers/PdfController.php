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
      $prescriptions =  DB::table('prescriptions')->where('ordonance','=',$id)->get();
        $ordonance = Ordonance::find($id);
        $doc = User::find($ordonance->user);
        $patient = Patient::find($ordonance->patient);
      $pdf = PDF::loadView('pdf.pdfordonance',['prescriptions'=> $prescriptions,'doc'=> $doc,'patient'=> $patient])->setPaper('a5');
      return $pdf->download('ordonnance.pdf');

    }

    public function facturePDF($id){
      $traitements =  DB::table('traitements')->where('facture','=',$id)->get();
        $facture = Facture::find($id);
        $facture->user = Auth::user()->id;
        $facture->save();
        $sec = User::find($facture->user);
        $patient = Patient::find($facture->patient);
        $total = 0;
      $pdf = PDF::loadView('pdf.pdffacture',['total'=> $total,'traitements'=> $traitements,'sec'=> $sec,'patient'=> $patient,'facture'=> $facture])->setPaper('a4', 'landscape');
      return $pdf->download('facture.pdf');

    }
}
