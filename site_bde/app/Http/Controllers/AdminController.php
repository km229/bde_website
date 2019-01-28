<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('login');
    }

 	public function index(){

        if(sizeof($_SESSION) > 0) {
            $table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

            if($table[0]->is_admin == 1) {
                $members = DB::table('members')->join('location', 'location_id_fk', "=", 'location_id')->get();
                return view('admin', compact('members'));
            }
        }
 	}
}
