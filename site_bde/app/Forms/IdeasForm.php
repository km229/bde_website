<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class IdeasForm extends Form
{
	public function buildForm()
	{
		$this->formOptions = [
			'method' => 'POST',
			'url' => route('ideas')
		];

		$this
		->add('name', 'text')
		->add('description', 'textarea')
		->add('submit', 'submit');
	}
}
