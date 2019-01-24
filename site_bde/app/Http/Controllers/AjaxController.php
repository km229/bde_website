<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

if(!isset($_SESSION)){
	session_start();
}

class AjaxController extends Controller
{
    public function search_activities(){
        
        $activity = DB::table('activity')->select('activity_id', 'activity_title', 'activity_desc')->whereRaw("activity_title REGEXP '".$_POST['search']."' OR activity_desc REGEXP '".$_POST['search']."'")->get();
        return $activity;
    }

    public function notif(){
    	DB::table('notifications')->where('member_id_fk', $_SESSION['id'])->delete();
        return 'ok';
    }
}
