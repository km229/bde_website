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

	public function __construct(){
		$this->middleware('login');
	}
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
			
			$member = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			$password = $member[0]->member_password;

			if((sizeof($test = DB::table('members')->get()->where('member_mail', $_POST['email'])) > 0) && ($_POST['email'])!==$member[0]->member_mail){
				return redirect(route('account'))->with('error', 'The email you provided already exists !');
			}

			if(!password_verify($_POST['old_password'], $password)){
				return redirect(route('account'))->with('error', 'Your password doesn\'t match !');
			}

			if($_POST['new_password'] !==""){
				if(!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/', $_POST['new_password'])){
					return redirect(route('account'))->with('error', 'The password entered does not meet the conditions !');
				} else {
					$password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
				}
			}

			DB::table('members')
			->where('member_id', $_SESSION["id"])
			->update(['member_firstname' => $_POST["first_name"], 'member_lastname' => $_POST["last_name"], 'member_mail' => $_POST['email'], 'member_password' => $password,'location_id_fk'=> ($_POST['location']+1)]);
			return redirect(route('account'))->with('success', 'Your information have been updated !');
		}
		return redirect()->back()->with('error', 'You must be connected to access to your account.');
	}
}
