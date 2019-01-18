<?php
namespace App\Http\Controllers;

use App\Forms\LoginForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Post;

if(!isset($_SESSION)){
	session_start();
}

class LoginController extends Controller
{

	public function index(FormBuilder $formbuilder){
		$form = $formbuilder->create(LoginForm::class);
		return view('login', compact('form'));
	}

	public function check(){
		if(!empty($_POST)){

			if(sizeof($member = DB::table('members')->get()->where('member_mail', $_POST['email'])) == 0){
				return redirect(route('login'));
			}

			$password = $member[0]->member_password;

			if($password !== $_POST['password']){
				return redirect(route('login'));
			}



			$_SESSION['name'] = $member[0]->member_firstname;
			$_SESSION['password'] = $_POST['password'];

			return redirect(route('welcome'));
		}
	}

	public function logout(){
		session_destroy();
		return redirect(route('welcome'));
	}
}
