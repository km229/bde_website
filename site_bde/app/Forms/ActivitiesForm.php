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
		->add('name', 'text')
		->add('description', 'textarea')
		->add('image', 'file')
		->add('date', 'date')
		->add('submit', 'submit');
	}
}
