<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ActivitiesCommentForm extends Form
{
	public function buildForm()
	{
		$r = $_SERVER['REQUEST_URI']; 
		$id = explode('/', $r)[2];
		$id2 = explode('_', $r)[1];

		$this->formOptions = [
			'method' => 'POST',
			'url' => route('activities_picture_check', ['id' => $id, 'id2' => $id2])
		];

		$this
		->add('commentary', 'text',[
			'rules' => 'required|min:1'
		])
		->add('submit', 'submit');
	}
}
