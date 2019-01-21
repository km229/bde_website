<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forms\AccountForm;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

if(!isset($_SESSION)){
	session_start();
}

class AccountController extends Controller
{
    //
	public function index(FormBuilder $formbuilder){
		$form = $formbuilder->create(AccountForm::class);
		return view('account', compact('form'));
	}

	public function orders(){
		return view('orders');
	}
	public function check(){
	if(!empty($_POST)){
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		DB::table('members')
			->where('member_id',$_SESSION["id"] )
			->update(['member_firstname' => $_POST["first_name"],'member_lastname' => $_POST["last_name"],'member_mail' => $_POST['email'],'member_password' => $password]);
		return redirect(route('account'));
		}
	}
}
