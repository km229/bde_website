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

	public function product_filter(){
		$categories = DB::table('category')->get();
		if($_POST['button']==='all') {
			if($_POST['min']!=='' && $_POST['max']!=='') {
				$sql_price=[$_POST['min'], $_POST['max']];
				$content=DB::table('product')->join('category', 'category_id_fk', '=', 'category_id')->whereBetween('product_price', $sql_price)->get();
				foreach ($content as $val) {
					$val->product_img=base64_encode($val->product_img);
				}
				return $content;
			} else {
				if($_POST['min']!=='') {
					$sql_price='category_name, \'>\', '.$_POST['min'];
				} if($_POST['max']!=='') {
					$sql_price='category_name, \'<\', '.$_POST['max'];
				} else {
					$content=DB::table('product')->join('category', 'category_id_fk', '=', 'category_id')->get();
					foreach ($content as $val) {
						$val->product_img=base64_encode($val->product_img);
					}
					return $content;
				}
				$content=DB::table('product')->join('category', 'category_id_fk', '=', 'category_id')->where($sql_price)->get();
				foreach ($content as $val) {
					$val->product_img=base64_encode($val->product_img);
				}
				return $content;
			}
		}
		foreach ($categories as $category) {
			if($category->category_name===$_POST['button']){
				$sql_cat=$category->category_name;
			}
		}
		if($_POST['min']!=='' && $_POST['max']!=='') {
			$sql_price=[$_POST['min'], $_POST['max']];
			$content=DB::table('product')->join('category', 'category_id_fk', '=', 'category_id')->where('category_name', $sql_cat)->whereBetween('product_price', $sql_price)->get();
			foreach ($content as $val) {
				$val->product_img=base64_encode($val->product_img);
			}
			return $content;
		} else {
			if($_POST['min']!=='') {
				$sql_price='category_name, \'>\', '.$_POST['min'];
			} if($_POST['max']!=='') {
				$sql_price='category_name, \'<\', '.$_POST['max'];
			} else {
				$content=DB::table('product')->join('category', 'category_id_fk', '=', 'category_id')->where('category_name', $sql_cat)->get();
				foreach ($content as $val) {
					$val->product_img=base64_encode($val->product_img);
				}
				return $content;
			}
			$content=DB::table('product')->join('category', 'category_id_fk', '=', 'category_id')->where('category_name', $sql_cat)->where($sql_price)->get();
			foreach ($content as $val) {
				$val->product_img=base64_encode($val->product_img);
			}
			return $content;
		}
	}

	public function search_ideas()
    {
        $ideas = DB::table('idea')->select('idea_id', 'idea_title', 'idea_desc')->whereRaw("idea_title REGEXP '".$_POST['search']."' OR idea_desc REGEXP '".$_POST['search']."'")->get();
        return $ideas;
    }

}
