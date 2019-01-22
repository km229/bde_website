<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ActivitiesForm extends Form
{
	public function buildForm()
	{
		$this->formOptions = [
			'method' => 'POST',
			'url' => route('activities_create_check')
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
