<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function search_activities(){
        
        $activity = DB::table('activity')->whereRaw("activity_title REGEXP '".$_POST['search']."' OR activity_desc REGEXP '".$_POST['search']."'")->get();
        return $activity;
    }
}
