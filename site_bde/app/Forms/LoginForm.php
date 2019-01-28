<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class LoginForm extends Form
{
	public function buildForm()
	{
		$this->formOptions = [
			'method' => 'POST',
			'url' => route('login')
		];

		if(isset($_COOKIE['email'])){
			$this
			->add('email', 'text',[
				'label'=>'E-mail',
				'rules'=>'required|min:1',
				'value'=> $_COOKIE['email']
			])
			->add('password', 'password',[
				'rules'=>'required|min:1'
			])

			->add('submit', 'submit',[
				'label' => 'Sign in'
			]); 
		}else{
			$this
			->add('email', 'text',[
				'label'=>'E-mail',
				'rules'=>'required|min:1'
			])
			->add('password', 'password',[
				'rules'=>'required|min:1'
			])

			->add('submit', 'submit',[
				'label' => 'Sign in'
			]);
		}

	}
}
