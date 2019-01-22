<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ActivitiesAddPictureForm extends Form
{
	public function buildForm()
	{

		$r = $_SERVER['REQUEST_URI']; 
		$id = explode('/', $r)[2];

		$this->formOptions = [
			'method' => 'POST',
			'url' => route('activities_add_picture_check', ['id' => $id])
		];

		$this
		->add('image', 'file',[
			'rules' => 'required|min:1'
		])
		->add('submit', 'submit');
	}
}
