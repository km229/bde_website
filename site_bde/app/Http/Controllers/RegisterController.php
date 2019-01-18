<?php

namespace App\Http\Controllers;

use App\Forms\RegisterForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

if(!isset($_SESSION)){
	session_start();
}

class RegisterController extends Controller
{
	public function index(FormBuilder $formbuilder){
		$form = $formbuilder->create(RegisterForm::class);
		return view('register', compact('form'));
	}

	public function check(){
		if(!empty($_POST)){

			if(sizeof($test = DB::table('members')->get()->where('member_mail', $_POST['email'])) > 0){
				$error = "email_exists";
				return redirect(route('register'))->with('error', 'email_exists');
			}

			DB::table('members')->insert(
				array(
					'member_firstname' => $_POST['first_name'],
					'member_lastname' => $_POST['last_name'],
					'member_mail' => $_POST['email'],
					'member_password' => $_POST['password'],
					'is_admin' => 0
				)
			);
			$_SESSION["name"]=$_POST["first_name"];
			return redirect(route('welcome'))->with('message', 'hello');
		}
	}
}
