<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{

	    public function index(){
        $activities = DB::table('activity')->orderBy('activity.activity_date', 'DESC')->limit(4)->get();
        $products = DB::table('product')->orderBy('product.product_sales_number', 'DESC')->limit(4)->get();
        return view('welcome', compact("activities"), compact("products"));
    }
}
