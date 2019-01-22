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
				return redirect(route('login'))->with('error', 'No account exists with this email address !');
			}

			$index = $member->keys()[0];

			$password = $member[$index]->member_password;

			if(!password_verify($_POST['password'], $password)){

				return redirect(route('login'))->with('error', 'Login problem: check your password !');
			}

			$_SESSION['name'] = $member[$index]->member_firstname;
			$_SESSION['id'] = $member[$index]->member_id;

			return redirect(route('welcome'))->with('success', 'Welcome back '. $_SESSION["name"] .' !');
		}
	}

	public function logout(){
		session_destroy();
		return redirect(route('welcome'));
	}
}
