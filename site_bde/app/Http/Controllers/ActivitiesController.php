<?php

namespace App\Http\Controllers;

use App\Forms\ActivitiesForm;
use App\Forms\ActivitiesCommentForm;
use App\Forms\ActivitiesIdForm;
use App\Forms\ActivitiesAddPictureForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

if(!isset($_SESSION)){
	session_start();
}

class ActivitiesController extends Controller
{
    //
	public function index(){
		$activities = DB::table('activity')->get();

		return view('activities.activities', compact("activities"));
	}

	public function create(FormBuilder $formbuilder){

		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->get()->where('member_id', $_SESSION['id']);
			$index = $table->keys()[0];

			if($table[$index]->is_admin == 1){
				$form = $formbuilder->create(ActivitiesForm::class);
				return view('activities.activities_create', compact('form'));
			}
		}
		
		return redirect(route('activities'));
	}

	public function create_check(){
		if(!empty($_POST)){
			DB::table('activity')->insert(
				array(
					'activity_title' => $_POST['name'],
					'activity_desc' => $_POST['description'],
					'activity_date' => $_POST['date'],
					'activity_img' => file_get_contents($_FILES['image']['tmp_name']),
					'activity_price' => $_POST['price'],
					'activity_recurrence' => $_POST['type']
				)
			);

			return redirect(route('activities'))->with('success', 'Activity "'.$_POST['name'].'" has been created');
		}
	}

	public function id($id){
		$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
		$verif = DB::table('link_members_activities')->where('member_id_fk' , $_SESSION['id'])->where('activity_id_fk' , $id)->get();
		$activity = DB::table('activity')->where('activity_id',$id)->get();
		return view('activities.activities_id', compact('id', 'table', 'verif', 'activity'));
	}

	public function id_update(FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

			if($table[0]->is_admin == 1){
				$form = $formbuilder->create(ActivitiesIdForm::class);
				return view('activities.activities_create', compact('form'));
			}
		}
		return redirect(route('activities'));
	}

	public function id_update_check(){
		if($_FILES['image']['tmp_name'] === ""){
			DB::table('activity')
			->where('activity_id',$_POST['id'])
			->update(['activity_title' => $_POST['name'],'activity_desc' => $_POST['description'],'activity_date' => $_POST['date'],'activity_price' => $_POST['price'],'activity_recurrence' => $_POST['type']]);
		}else{
			DB::table('activity')
			->where('activity_id',$_POST['id'])
			->update(['activity_title' => $_POST['name'],'activity_desc' => $_POST['description'],'activity_img' => file_get_contents($_FILES['image']['tmp_name']),'activity_date' => $_POST['date'],'activity_price' => $_POST['price'],'activity_recurrence' => $_POST['type']]);
		}
		return redirect(route('activities'))->with('success', 'Activity "'.$_POST['name'].'" updated');
	}

	public function delete($id){

		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

			if($table[0]->is_admin == 1){

				DB::table('link_members_activities')
				->where('activity_id_fk',$id)
				->delete();

				$test = DB::table('activity_pictures')
				->join('comment_picture_member', 'picture_id', '=', 'picture_id_fk')
				->where('activity_id_fk',$id);

				foreach ($test->get() as $el) {
					DB::table('comment_picture_member')
					->where('picture_id_fk',$el->picture_id)
					->delete();
				}

				$test = DB::table('activity_pictures')
				->join('like_picture_member', 'picture_id', '=', 'picture_id_fk')
				->where('activity_id_fk',$id);

				foreach ($test->get() as $el) {
					DB::table('like_picture_member')
					->where('picture_id_fk',$el->picture_id)
					->delete();
				}
				
				DB::table('activity_pictures')
				->where('activity_id_fk',$id)
				->delete();

				$name = DB::table('activity')
				->where('activity_id',$id)
				->get();

				DB::table('activity')
				->where('activity_id',$id)
				->delete();

				return redirect(route('activities'))->with('success', 'Activity "'.$name[0]->activity_title.'" has been deleted');
			}
		}
		return redirect(route('activities'));
		
	}

	public function join($id){

		if(sizeof($_SESSION) > 0){

			$verif = DB::table('link_members_activities')->where('member_id_fk' , $_SESSION['id'])->where('activity_id_fk' , $id)->get();
			
			$activity = DB::table('activity')->where('activity_id',$id)->get();

			if($activity[0]->activity_date > date('Y-m-d')){
				if(sizeof($verif)==0){
					DB::table('link_members_activities')->insert(array(
						'member_id_fk' => $_SESSION['id'],
						'activity_id_fk' => $id
					));
					return redirect(route('activities_id',['id'=>$id]))->with('success', 'You joined the activity "'.$activity[0]->activity_title.'"');
				}
			}
		}
		
		return redirect(route('activities'));
	}

	public function leave($id){

		if(sizeof($_SESSION) > 0){

			$verif = DB::table('link_members_activities')->where('member_id_fk' , $_SESSION['id'])->where('activity_id_fk' , $id)->get();
			
			$activity = DB::table('activity')->where('activity_id',$id)->get();

			if($activity[0]->activity_date > date('Y-m-d')){
				if(sizeof($verif)!=0){
					DB::table('link_members_activities')->where('member_id_fk' , $_SESSION['id'])->where('activity_id_fk' , $id)->delete();
					$test = DB::table('activity')->where('activity_id', $id)->get();
					return redirect(route('activities_id',['id'=>$id]))->with('success', 'You left the activity "'.$test[0]->activity_title.'"');
				}
			}
		}

		return redirect(route('activities'));

	}

	public function add_picture($id, FormBuilder $formbuilder){
		$activity = DB::table('activity')->where('activity_id',$id)->get();
		if($activity[0]->activity_date < date('Y-m-d')){
			$form = $formbuilder->create(ActivitiesAddPictureForm::class);
			return view('activities.activities_create', compact('form'));
		}
		return redirect(route('activities_id',['id'=>$id]));
	}

	public function add_picture_check($id){
		DB::table('activity_pictures')->insert(array(
			'picture_img' => file_get_contents($_FILES['image']['tmp_name']),
			'activity_id_fk' => $id
		));
		return redirect(route('activities_id', ['id'=>$id]))->with('success', 'Picture added');

	}

	public function picture($id, $id2, FormBuilder $formbuilder){

		$form = $formbuilder->create(ActivitiesCommentForm::class);

		$idea = DB::table('activity_pictures')->where('picture_id', '=', $id2)->get();
		$like = DB::table('activity_pictures')->select(DB::raw('picture_id, COUNT(picture_id) as picture_likes'))->join('like_picture_member', 'picture_id', '=', 'picture_id_fk')->groupBy('picture_id')->where('picture_id', '=', $id2)->get();
		$verif_like = DB::table('activity_pictures')->join('like_picture_member', 'picture_id', '=', 'picture_id_fk')->where('member_id_fk', $_SESSION['id'])->where('picture_id', $id2)->get();
		return view('activities.activities_id_pictures', compact('idea', 'like', 'verif_like', 'id', 'id2', 'form'));


	}

	public function picture_check($id, $id2){

		DB::table('comment_picture_member')->insert(array(

			'picture_id_fk' => $id2,
			'member_id_fk' => $_SESSION['id'],
			'comment' => $_POST['commentary'],
			'comment_date' => date ('y-m-d-H\hi')

		));

		return redirect(route('activities_picture', ['id'=> $id, 'id2'=>$id2]));

	}

	public function picture_delete($id, $id2){


		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->get()->where('member_id', $_SESSION['id']);
			$index = $table->keys()[0];

			if($table[$index]->is_admin == 1){
				DB::table('like_picture_member')
				->where('picture_id_fk',$id2)
				->delete();

				$test = DB::table('activity_pictures')
				->join('comment_picture_member', 'picture_id', '=', 'picture_id_fk')
				->where('activity_id_fk',$id);

				foreach ($test->get() as $el) {
					DB::table('comment_picture_member')
					->where('picture_id_fk',$el->picture_id)
					->delete();
				}
				
				DB::table('activity_pictures')
				->where('picture_id',$id2)
				->delete();
				return redirect(route('activities_id', ['id'=> $id]))->with('success', 'Picture deleted');
			}
		}
		return redirect(route('activities_id', ['id'=> $id]));

	}
}
