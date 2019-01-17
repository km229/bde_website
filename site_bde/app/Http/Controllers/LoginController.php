<?php

namespace App\Http\Controllers;

use App\Forms\LoginForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Post;

class LoginController extends Controller
{

    public function index(FormBuilder $formbuilder){
        $form = $formbuilder->create(LoginForm::class);
        return view('login', compact('form'));
    }

    public function check(){
		if(!empty($_POST)){

			if(sizeof($test = DB::table('members')->get()->where('member_mail', $_POST['email'])) == 0){
				return redirect(route('login'));
			}
			
			Session::put('name', $_POST['email']);
			Session::put('password', $_POST['password']);

			return redirect(route('welcome'));
		}
	}
}
