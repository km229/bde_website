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

			if(sizeof($member = DB::table('members')->where('member_mail', $_POST['email'])->get()) == 0){
				return redirect(route('login'))->with('error', 'No account exists with this email address !');
			}

			$password = $member[0]->member_password;

			if(!password_verify($_POST['password'], $password)){

				return redirect(route('login'))->with('error', 'Login problem: check your password !');
			}

			setcookie('email', $member[0]->member_mail , time() + 365*24*3600);

			$_SESSION['name'] = $member[0]->member_firstname;
			$_SESSION['id'] = $member[0]->member_id;

			return redirect(route('welcome'))->with('success', 'Welcome back '. $_SESSION["name"] .' !');
		}
	}

	public function logout(){
		session_destroy();
		return redirect(route('welcome'));
	}
}
