<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\DB;

if(!isset($_SESSION)){
	session_start();
}

class AccountForm extends Form
{
	public function buildForm()
	{
		$this->formOptions = [
			'method' => 'POST',
			'url' => route('account')
		];

		$table = DB::table('members')->get()->where('member_mail', $_SESSION['email']);

		$index = $table->keys()[0];

		$member = $table[$index];

		$this
		->add('first_name', 'text',[
			'value' => $member->member_firstname
		])
		->add('last_name', 'text',[
			'value' => $member->member_lastname
		])
		->add('location', 'text',[
			'value' => 'test'
		])
		->add('email', 'email',[
			'value' => $member->member_mail
		])
		->add('submit', 'submit',[
			'label' => 'Sign up'
		]);
	}
}
