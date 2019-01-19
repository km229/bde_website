<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forms\AccountForm;
use Kris\LaravelFormBuilder\FormBuilder;

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
}
