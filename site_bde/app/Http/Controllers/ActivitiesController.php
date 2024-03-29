<?php

namespace App\Http\Controllers;

use App\Forms\ActivitiesForm;
use App\Forms\ActivitiesCommentForm;
use App\Forms\ActivitiesIdForm;
use App\Forms\ActivitiesAddPictureForm;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;
use ZipArchive;

if(!isset($_SESSION)){
	session_start();
}

class ActivitiesController extends Controller
{
	
	public function index(){
		$activities = DB::table('activity')->paginate(9);
		$links = $activities->render();
		$recurringactivities = DB::table('activity')->get()->where('activity_recurrence', !0);
		if(!empty($recurringactivities)) {
			ActivitiesController::update_activities($recurringactivities);
			$activities = DB::table('activity')->paginate(9);
		}
		return view('activities.activities', compact("activities", "links"));
	}

	public function update_activities($activities){
		foreach($activities as $activity){

			$activity_date = date_create();
			date_timestamp_set($activity_date, strtotime($activity -> activity_date));
            //$datetime = new DateTime($activity -> activity_date);
			$today = strtotime(date('Y-m-d'));
            //dd($activity_date->format('d'));
			if (strtotime($activity_date->format("Y-m-d")) < $today) {
				switch ($activity->activity_recurrence) {
					case 1:
					$i = 0;
					do {
						$i += 1;
						$tmp = date('Y-m-d', mktime(0, 0, 0, $activity_date->format('m'), $activity_date->format('d') + 7 * $i, $activity_date->format('Y')));
					} while ($today > strtotime($tmp));

					DB::table('activity')->insert(
						array(
							'activity_title' => $activity->activity_title,
							'activity_desc' => $activity->activity_desc,
							'activity_date' => $tmp,
							'activity_img' => $activity->activity_img,
							'activity_price' => $activity->activity_price,
							'activity_recurrence' => $activity->activity_recurrence
						)
					);
					break;
					case 2:
					$i = 0;
					do {
						$i += 1;
						$tmp = date('Y-m-d', mktime(0, 0, 0, $activity_date->format('m') + 1 * $i, $activity_date->format('d'), $activity_date->format('Y')));
					} while ($today > strtotime($tmp));

					DB::table('activity')->insert(
						array(
							'activity_title' => $activity->activity_title,
							'activity_desc' => $activity->activity_desc,
							'activity_date' => $tmp,
							'activity_img' => $activity->activity_img,
							'activity_price' => $activity->activity_price,
							'activity_recurrence' => $activity->activity_recurrence
						)
					);
					break;
					case 3:
					$i = 0;
					do {
						$i += 1;
						$tmp = date('Y-m-d', mktime(0, 0, 0, $activity_date->format('m'), $activity_date->format('d'), $activity_date->format('Y') + 1 * $i));
					} while ($today > strtotime($tmp));

					DB::table('activity')->insert(
						array(
							'activity_title' => $activity->activity_title,
							'activity_desc' => $activity->activity_desc,
							'activity_date' => $tmp,
							'activity_img' => $activity->activity_img,
							'activity_price' => $activity->activity_price,
							'activity_recurrence' => $activity->activity_recurrence
						)
					);
					break;
				}
				DB::table('activity')->where('activity_id', $activity->activity_id)->update(
					array(
						'activity_recurrence' => 0
					)
				);
			}
		}
	}
	
	public function search(){
		$search=$_GET['request'];
		if($search===""){
			return redirect()->back();
		}
		$activities = DB::table('activity')->whereRaw("activity_title REGEXP '".$search."' OR activity_desc REGEXP '".$search."'")->paginate(9);
		$verif_activity = DB::table('activity')->whereRaw("activity_title REGEXP '".$search."' OR activity_desc REGEXP '".$search."'")->get();
		$activities->withPath('/activities/search?request='.$_GET['request']);
		$links = $activities->render();
		return view('activities.research', compact("activities", "links", "search", "verif_activity"));
	}

	public function create(FormBuilder $formbuilder){

		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

			if($table[0]->is_admin == 1){
				$form = $formbuilder->create(ActivitiesForm::class);
				return view('activities.activities_create', compact('form'));
			}
		}
		
		return redirect()->back()->with('error', 'You are not allowed to create an activity.');
	}

	public function create_check(){

		if(!empty($_POST)){
			
			if(sizeof($_SESSION) > 0){
				$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

				if($table[0]->is_admin == 1){
					if(isset($_POST['hidden'])){
						$table_idea = DB::table('idea')-> where('idea_id', $_POST['hidden'])->get();
						DB::table('notifications')->insert(array(
							'notif_desc' => 'Your idea "'.$table_idea[0]->idea_title.'" is now the activity : '.$_POST['name'],
							'member_id_fk' => $table_idea[0]->member_id_fk
						));
					}
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

					return redirect(route('activities'))->with('success', 'Activity "'.$_POST['name'].'" has been created.');
				}
				return redirect(route('activities'))->with('error', 'You are not allowed to create an activity.');
				
			}

		}
		return redirect()->back();
	}

	public function id($id){
		$activity = DB::table('activity')->where('activity_id',$id)->get();
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			$verif = DB::table('link_members_activities')->where('member_id_fk' , $_SESSION['id'])->where('activity_id_fk' , $id)->get();
			return view('activities.activities_id', compact('id', 'table', 'verif', 'activity'));
		}
		return redirect()->back()->with('error', 'You must be connected to see an activity.');
	}

	public function id_update(FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

			if($table[0]->is_admin == 1){
				$form = $formbuilder->create(ActivitiesIdForm::class);
				return view('activities.activities_create', compact('form'));
			}
		}
		return redirect()->back()->with('error', 'You are not allowed to update an activity.');
	}

	public function id_update_check(){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

			if($table[0]->is_admin == 1){
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
			return redirect(route('activities'))->with('error', 'You are not allowed to update an activity.');
		}
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

				return redirect(route('activities'))->with('success', 'Activity "'.$name[0]->activity_title.'" deleted !');
			}
		}
		return redirect()->back()->with('error', 'You are not allowed to delete an activity.');;

	}

	public function join($id){

		if(sizeof($_SESSION) > 0){
			DB::table('link_members_activities')->insert(array(
				'member_id_fk' => $_SESSION['id'],
				'activity_id_fk' => $id
			));
			$test = DB::table('activity')->where('activity_id', $id)->get();
			return redirect(route('activities_id',['id'=>$id]))->with('success', 'You joined the activity "'.$test[0]->activity_title.'"');
		}
		return redirect(route('activities'));
	}

	public function leave($id){

		if(sizeof($_SESSION) > 0){
			DB::table('link_members_activities')->where('member_id_fk' , $_SESSION['id'])->where('activity_id_fk' , $id)->delete();
			$test = DB::table('activity')->where('activity_id', $id)->get();
			return redirect(route('activities_id',['id'=>$id]))->with('success', 'You left the activity "'.$test[0]->activity_title.'"');
		}

		return redirect(route('activities'));

	}

	public function add_picture($id, FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$form = $formbuilder->create(ActivitiesAddPictureForm::class);
			return view('activities.activities_create', compact('form'));
		}
	}

	public function add_picture_check($id){
		if(sizeof($_SESSION) > 0){
			DB::table('activity_pictures')->insert(array(
				'picture_img' => file_get_contents($_FILES['image']['tmp_name']),
				'activity_id_fk' => $id
			));
			return redirect(route('activities_id', ['id'=>$id]))->with('success', 'Picture added');
		}
	}

	public function picture($id, $id2, FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$form = $formbuilder->create(ActivitiesCommentForm::class);
			$idea = DB::table('activity_pictures')->where('picture_id', '=', $id2)->get();
			$like = DB::table('activity_pictures')->select(DB::raw('picture_id, COUNT(picture_id) as picture_likes'))->join('like_picture_member', 'picture_id', '=', 'picture_id_fk')->groupBy('picture_id')->where('picture_id', '=', $id2)->get();
			$verif_like = DB::table('activity_pictures')->join('like_picture_member', 'picture_id', '=', 'picture_id_fk')->where('member_id_fk', $_SESSION['id'])->where('picture_id_fk', $id2)->get();
			return view('activities.activities_id_pictures', compact('idea', 'like', 'verif_like', 'id', 'id2', 'form', 'verif'));
		}

	}

	public function picture_check($id, $id2){
		if(sizeof($_SESSION) > 0){
			DB::table('comment_picture_member')->insert(array(

				'picture_id_fk' => $id2,
				'member_id_fk' => $_SESSION['id'],
				'comment' => $_POST['commentary'],
				'comment_date' => date ('y-m-d-H\hi')

			));

			return redirect(route('activities_picture', ['id'=> $id, 'id2'=>$id2]));
		}
	}

	public function download_registration($id)
	{
		if(sizeof($_SESSION) > 0){
			$result = DB::table('link_members_activities')->join('members', 'member_id_fk', '=', 'member_id')->where('activity_id_fk', $id)->get();
			$user = $result->where('member_id', $_SESSION['id'])[0];
			if($user->is_admin == 1){
				$headers = array();

				if (sizeof($result) != 0) {
					foreach ($result as $member) {
						$headers[] = utf8_decode($member->member_firstname) . ';' . utf8_decode($member->member_lastname). ";" . utf8_decode($member->member_mail);
					}
				}

				$fp = fopen('php://output', 'w');

				if ($fp && $result) {
					header('Content-Type: text/csv');
					header('Content-Disposition: attachment; filename="registrations.csv"');
					header('Pragma: no-cache');
					header('Expires: 0');
					foreach ($headers as $field){
						fwrite($fp, $field."\n");
					}

					die;
				}
				return(ActivitiesController::id($id));
			}
			return redirect()->back()->with('error', 'You are not allowed to download the list of participants.');
		}
		return redirect()->back()->with('error', 'Your must be connected before to download.');
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
			return redirect()->back()->with('error', 'You are not allowed to delete a picture.');
		}
		return redirect(route('activities_id', ['id'=> $id]))->with('error', 'You must be connected to continue.');
	}

	public function comment_delete($id, $id2, $id3){

		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

			if($table[0]->is_admin == 1){
				DB::table('comment_picture_member')
				->where('comment_id',$id3)
				->delete();

				return redirect(route('activities_picture', ['id'=> $id, 'id2'=>$id2]))->with('success', 'Commentary deleted');
			}
		}
		return redirect(route('activities_id', ['id'=> $id, 'id2'=>$id2]))->with('error', 'You can\'t delete this commentary');

	}

	public function warning($id){

		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

			if($table[0]->state_name != 'Student'){
				$table_members = DB::table('members')-> where('is_admin', '1')->get();
				$table_activity = DB::table('activity')-> where('activity_id', $id)->get()[0];
				$table_reporter = DB::table('members')-> where('member_id', $_SESSION['id'])->get()[0];
				foreach ($table_members as $member) {
					DB::table('notifications')->insert(array(
						'notif_desc' => '<a href="/activities/'.$id.'">This activity</a> has been reported by '.$table_reporter->member_firstname.' '.$table_reporter->member_lastname,
						'member_id_fk' => $member->member_id
					));
				}
				return redirect(route('activities'));
			}
		}
		return redirect(route('activities'));
	}

	public function picture_warning($id, $id2){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

			if($table[0]->state_name != 'Student'){
				$table_members = DB::table('members')-> where('is_admin', '1')->get();
				$table_activity = DB::table('activity')-> where('activity_id', $id)->get()[0];
				$table_reporter = DB::table('members')-> where('member_id', $_SESSION['id'])->get()[0];
				foreach ($table_members as $member) {
					DB::table('notifications')->insert(array(
						'notif_desc' => '<a href="/activities/'.$id.'/img_'.$id2.'">This picture </a> has been reported by '.$table_reporter->member_firstname.' '.$table_reporter->member_lastname,
						'member_id_fk' => $member->member_id
					));
				}
			}
			return redirect()->back()->with('error', 'You are not allowed to report a picture.');
		}
		return redirect()->back()->with('error', 'You must be connected before to continue.');
	}

	public function comment_warning($id, $id2, $id3){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

			if($table[0]->state_name != 'Student'){
				$table_members = DB::table('members')-> where('is_admin', '1')->get();
				$table_comment = DB::table('activity_pictures')->join('comment_picture_member','picture_id','=','picture_id_fk')->join('members', 'member_id_fk','=','member_id')->join('activity','activity_id_fk', '=', 'activity_id')-> where('comment_id', $id3)->get()[0];
				$table_reporter = DB::table('members')-> where('member_id', $_SESSION['id'])->get()[0];

				foreach ($table_members as $member) {
					DB::table('notifications')->insert(array(
						'notif_desc' => '<a href="/activities/'.$id.'/img_'.$id2.'#comment_'.$id3.'">This commentary </a> has been reported by '.$table_reporter->member_firstname.' '.$table_reporter->member_lastname,
						'member_id_fk' => $member->member_id
					));
				}
			}
			return redirect()->back()->with('error', 'You are not allowed to report a comment.');
		}
		return redirect()->back()->with('error', 'You must be connected before to continue.');
	}

	public function download_picture($id){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

			if($table[0]->state_name != 'Student'){
				$table = DB::table('activity_pictures')->where('activity_id_fk', $id)->get();
				$folder = 'tempDL/activity'.$id;
				if(!file_exists($folder)){
					mkdir($folder);
				}
				$zip = new ZipArchive();
				$zip->open($folder.'.zip', ZipArchive::CREATE);
				foreach ($table as $el) {
					$file = $folder.'/img'.$el -> picture_id.'.png';
					file_put_contents($file, $el -> picture_img);	
					$zip->addFile($file);		
				}

				$zip->close();

				$objects = scandir($folder);
				foreach ($objects as $object) {
					if($object !== '.' && $object !== '..'){
						unlink($folder."/".$object);
					}
				}
				reset($objects);
				rmdir($folder);
				header('Content-disposition: attachment; filename='.$folder.'.zip'); 
				header('Content-Type: application/force-download'); 
				header('Content-Transfer-Encoding: fichier');  
				header('Content-Length: '.filesize($folder.'.zip')); 
				header('Pragma: no-cache'); 
				header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0'); 
				header('Expires: 0'); 
				readfile($folder.'.zip');
			}
		}
		return redirect()->back()->with('error', 'You are not allowed to download pictures.');
	}
}