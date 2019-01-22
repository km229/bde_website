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

			return redirect(route('activities'));
		}
	}

	public function id($id){
		return view('activities.activities_id', compact('id'));
	}

	public function id_update(FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->get()->where('member_id', $_SESSION['id']);
			$index = $table->keys()[0];

			if($table[$index]->is_admin == 1){
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
		return redirect(route('activities'));
	}

	public function delete($id){

		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->get()->where('member_id', $_SESSION['id']);
			$index = $table->keys()[0];

			if($table[$index]->is_admin == 1){
				DB::table('link_members_activities')
				->where('activity_id_fk',$id)
				->delete();

				DB::table('activity')
				->where('activity_id',$id)
				->delete();
				return redirect(route('activities'));
			}
		}
		return redirect(route('activities'));
		
	}

	public function join($id){

		if(sizeof($_SESSION) > 0){
			DB::table('link_members_activities')->insert(array(
				'member_id_fk' => $_SESSION['id'],
				'activity_id_fk' => $id
			));

			return redirect(route('activities_id',['id'=>$id]));
		}
		return redirect(route('activities'));
		
		
	}

	public function leave($id){

		if(sizeof($_SESSION) > 0){
			DB::table('link_members_activities')->where('member_id_fk' , $_SESSION['id'])->where('activity_id_fk' , $id)->delete();

			return redirect(route('activities_id',['id'=>$id]));
		}

		return redirect(route('activities'));

	}

	public function add_picture($id, FormBuilder $formbuilder){

		$form = $formbuilder->create(ActivitiesAddPictureForm::class);
		return view('activities.activities_create', compact('form'));

	}

	public function add_picture_check($id){
		DB::table('activity_pictures')->insert(array(
			'picture_img' => file_get_contents($_FILES['image']['tmp_name']),
			'activity_id_fk' => $id
		));
		return redirect(route('activities_id', ['id'=>$id]));

	}

	public function picture($id, $id2, FormBuilder $formbuilder){
		$form = $formbuilder->create(ActivitiesCommentForm::class);
		return view('activities.activities_id_pictures', compact('form'));

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
}
