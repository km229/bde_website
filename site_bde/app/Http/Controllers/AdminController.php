<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
 	public function index(){
 		$members = DB::table('members')->join('location', 'location_id_fk',"=",'location_id')->get();
 		return view('admin', compact('members'));
 	}
}
