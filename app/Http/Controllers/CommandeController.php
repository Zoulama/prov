<?php namespace LeadAssurance\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use LeadAssurance\Http\Requests;

class CommandeController extends Controller
{
    
    public function index(){
    	$test = '';
    	return view('LeadDashboard.commande.index',compact('test'));
    }

    public function commandes(){
    	$user 		= Auth::user();
    	$commandes  = $user->commande();
    	return view('LeadDashboard.commande.commande',compact('commandes'));
    }
}
