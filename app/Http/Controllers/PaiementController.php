<?php namespace LeadAssurance\Http\Controllers;

use Illuminate\Http\Request;
use LeadAssurance\Http\Requests;

class PaiementController extends Controller
{
    public function payment(){
    	
    }

    public function transAnnule(Request $request){
        if ($request->has('Mt') && $request->has('Ref') && $request->has('Trans')){
                $montant=$request->Mt;
                $ref_com=$request->Ref;
                $trans=$request->Trans;
        }
        return view('LeadDashboard.paiement.transaction_annule',compact('montant','ref_com','trans'));
    }
}
