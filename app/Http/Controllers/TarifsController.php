<?php

namespace LeadAssurance\Http\Controllers;

use Illuminate\Http\Request;
use LeadAssurance\Http\Requests;
use LeadAssurance\Classes\Tarif;

class TarifsController extends Controller
{
    public function index(){
    	$tarifs=Tarif::tarifProspect();

    	return view('LeadDashboard.tarifs', compact('tarifs'));
    }
}
