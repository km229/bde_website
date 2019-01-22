<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\DB;

class ActivitiesForm extends Form
{
	public function buildForm()
	{
		$this->formOptions = [
			'method' => 'POST',
			'url' => route('activities_create_check')
		];
		
		if(isset($_GET['id'])){
			$info = DB::table('idea')->where('idea_id', $_GET['id'])->get();
			$this
		->add('name', 'text',[
			'rules' => 'required|min:1',
			'value' =>	$info[0]->idea_title
		])
		->add('description', 'textarea',[
			'rules' => 'required|min:1',
			'value' =>	$info[0]->idea_desc
		]);
		} else {
			$this
		->add('name', 'text',[
			'rules' => 'required|min:1'
		])
		->add('description', 'textarea',[
			'rules' => 'required|min:1'
		]);
		}
		$this->add('image', 'file',[
			'rules' => 'required|min:1'
		])
		->add('date', 'date',[
			'rules' => 'required'
		])
		->add('price', 'number',[
			'rules' => 'required'
		])
		->add('type', 'choice',[
			'choices' => ['Punctual','Recurrent'],
			'multiple' => false,
			'expanded' => true,
			'selected' => 0
		])
		->add('submit', 'submit');
	}
}
