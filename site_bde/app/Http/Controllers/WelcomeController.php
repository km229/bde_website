<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index(){
        $activities = DB::table('activity')->orderBy('activity.activity_date', 'DESC')->get();
        return view('welcome', compact("activities"));
    }
}
