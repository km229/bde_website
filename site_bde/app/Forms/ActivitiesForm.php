<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ActivitiesForm extends Form
{
	public function buildForm()
	{
		$this->formOptions = [
			'method' => 'POST',
			'url' => route('activities_create_check'),
			'enctype' => 'multipart/form-data'
		];

		$this
		->add('name', 'text',[
			'rules' => 'required|min:1'
		])
		->add('description', 'textarea',[
			'rules' => 'required|min:1'
		])
		->add('image', 'file',[
			'rules' => 'required|min:1'
		])
		->add('date', 'date',[
			'rules' => 'required'
		])
		->add('submit', 'submit');
	}
}
