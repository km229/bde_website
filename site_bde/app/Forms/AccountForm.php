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
			'url' => route('account_check')
		];

		$table = DB::table('members')
			->join('location', 'location_id_fk', '=', 'location_id')
			->get()->where('member_id', $_SESSION['id']);

			$db = DB::table('location')->get();
			$array = [];
			foreach($db as $choice){
				$array[] = $choice;
	
			}
			$table2 = [];
	
			for($i = 0; $i < sizeof($array); $i++){
				$table2[] =  $array[$i] -> location_center;
			}

			$index = $table->keys()[0];
		$index = $table->keys()[0];
		//dd($table[$index] -> location_id);
		$member = $table[$index];
		$this
		->add('first_name', 'text',[
			'value' => $member->member_firstname
		])
		->add('last_name', 'text',[
			'value' => $member->member_lastname
		])
		
		->add('location', 'choice',[	
			'choices' => $table2,
			'data' => ($table[$index] -> location_center)		
		])
		
		->add('email', 'email',[
			'value' => $member->member_mail
		])
		->add('old_password', 'password',[
			'rules'=>'required|min:1'
		])
		->add('new_password', 'password',[
			'rules'=>'regex:(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}'
		])
		->add('submit', 'submit',[
			'label' => 'Change'
		]);
	}
}
