<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function legal(){
    	return view('legal_terms');
    }
    public function terms(){
    	return view('terms_conditions');
    }
}
