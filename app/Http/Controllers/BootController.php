<?php

namespace LeadAssurance\Http\Controllers;
use Illuminate\Http\Request;
use LeadAssurance\Http\Requests;

class BootController extends Controller
{
    //

    public function bootInit(){
        return view('Bootinit.index');
    }

    public function ccm(){

        return view('Bootinit.ccm');
    }

    public function about(){

        return view('Bootinit.about');
    }

    public function legal(){

        return view('Bootinit.legal');
    }

    public function cgu(){

        return view('Bootinit.cgu');
    }

    public function contact(){

        return view('Bootinit.contact');
    }
}
