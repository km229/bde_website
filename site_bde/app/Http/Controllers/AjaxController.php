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

    public function change_like_idea($id){
		if(isset($_POST['affect']) && isset($_SESSION['id'])){
			switch ($_POST['affect']) {
				case 'Like':
				DB::table('link_member_idea_like')->insert(['member_id_fk' => $_SESSION['id'], 'idea_id_fk' => $id]);
				return 'ok';
				break;
				case 'Dislike':
				DB::table('link_member_idea_like')->where('member_id_fk', $_SESSION['id'])->where('idea_id_fk', $id)->delete();
				return 'ok';
				break;
				default:
				return 'ko';
				break;
			}
		}
		return 'ko';
    }
    
    public function change_activity_picture_like($id, $id2){
        if(isset($_POST['affect']) && isset($_SESSION['id'])){
			switch ($_POST['affect']) {
				case 'Like':
				DB::table('like_picture_member')->insert(['member_id_fk' => $_SESSION['id'], 'picture_id_fk' => $id2]);
				return 'ok';
				break;
				case 'Dislike':
				DB::table('like_picture_member')->where('member_id_fk', $_SESSION['id'])->where('picture_id_fk', $id2)->delete();
				return 'ok';
				break;
				default:
				return 'ko';
				break;
			}
		}
		return 'ko';
    }

    public function search_acticles()
    {
        $articles = DB::table('product')->select('product_id', 'product_name', 'product_desc', 'product_price')->whereRaw("product_name REGEXP '".$_POST['search']."' OR product_desc REGEXP '".$_POST['search']."'")->get();
        return $articles;
    }

}
