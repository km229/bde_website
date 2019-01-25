<?php

namespace App\Http\Controllers;

use App\Forms\IdeasForm;
use App\Forms\IdeasIdForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

if(!isset($_SESSION)){
	session_start();
}

class IdeasController extends Controller
{
    //
	public function create(FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$form = $formbuilder->create(IdeasForm::class);
			return view('ideas.ideas_create', compact('form'));
		}else{
			return redirect(route('ideas'))->with('error', 'You don\'t have permission to access this page, please sign in');
		}
	}

	public function create_check(){
		if(!empty($_POST)){

			DB::table('idea')->insert(
				array(
					'idea_title' => $_POST['name'],
					'idea_desc' => $_POST['description'],
					'member_id_fk' => $_SESSION['id']
				)
			);
			return redirect(route('ideas'))->with('success', 'Your idea has been added !');
		}
	}

	public function index(){
		$ideas = DB::table('idea')->join('members', 'idea.member_id_fk', '=', 'members.member_id')->paginate(9);
		$likes = DB::table('idea')->select(DB::raw('idea_id, COUNT(idea_id) as idea_likes'))->join('link_member_idea_like', 'idea_id', '=', 'idea_id_fk')->groupBy('idea_id')->get();
		$links = $ideas->render();
		return view('ideas.ideas', compact("ideas", "likes", "links"));
	}

	public function display_idea($id){
		if(sizeof($_SESSION) > 0){
			$idea = DB::table('idea')->where('idea_id', '=', $id)->get();
			$like = DB::table('idea')->select(DB::raw('idea_id, COUNT(idea_id) as idea_likes'))->join('link_member_idea_like', 'idea_id', '=', 'idea_id_fk')->groupBy('idea_id')->where('idea_id', '=', $id)->get();
			$verif_like = DB::table('idea')->join('link_member_idea_like', 'idea.idea_id', '=', 'link_member_idea_like.idea_id_fk')->where('idea.member_id_fk', $_SESSION['id'])->where('idea_id', $id)->get();
			return view('ideas.ideas_id', compact('idea', 'like', 'verif_like'));
		}else{
			return redirect(route('ideas'))->with('error', 'You don\'t have permission to access this page, please sign in');
		}

	}

	public function idea_delete($id){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			$idea = DB::table('idea')->where('idea_id', '=', $id)->get();
			
			if(($_SESSION['id']===$idea[0]->member_id_fk) || ($table[0]->is_admin == 1)){
				DB::table('link_member_idea_like')->where('idea_id_fk', '=', $id)->delete();
				DB::table('idea')->where('idea_id', '=', $id)->delete();
				return redirect(route('ideas'))->with('success', 'Idea deleted !');
			}
			
		}
		return redirect(route('ideas'))->with('error', 'You don\'t have permission to access this page, please sign in');
	}

	public function idea_update($id, FormBuilder $formbuilder){

		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			$idea = DB::table('idea')->where('idea_id', '=', $id)->get();

			if(($_SESSION['id']===$idea[0]->member_id_fk) || ($table[0]->is_admin == 1)){
				$form = $formbuilder->create(IdeasIdForm::class);
				return view('ideas.ideas_create', compact('form'));
			}
			
		}
		return redirect(route('ideas'))->with('error', 'You don\'t have permission to access this page, please sign in');
		
	}

	public function idea_update_check($id){
		DB::table('idea')->where('idea_id', '=', $id)->update(['idea_title'=>$_POST['name'], 'idea_desc'=>$_POST['description']]);
		return redirect(route('idea',['id'=>$id]));
	}

}
