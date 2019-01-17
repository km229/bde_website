<?php

namespace App\Http\Controllers;

use App\Forms\RegisterForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
	public function index(FormBuilder $formbuilder){
		$form = $formbuilder->create(RegisterForm::class);
		return view('register', compact('form'));
	}

	public function check(){
		if(!empty($_POST)){

			if(sizeof($test = DB::table('members')->get()->where('member_mail', $_POST['email'])) > 0){
				return redirect(route('register'));
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
			return redirect(route('login'));
		}
	}
}
