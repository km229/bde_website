<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\DB;

if(!isset($_SESSION)){
	session_start();
}

class ActivitiesIdForm extends Form
{
	public function buildForm()
	{

		$r = $_SERVER['REQUEST_URI']; 
		$id = explode('/', $r)[2];

		$this->formOptions = [
			'method' => 'POST',
			'url' => route('activities_id_update_check')
		];

		$table = DB::table('activity')->get()->where('activity_id', $id);

		$index = $table->keys()[0];



		$activity = $table[$index];

		$this
		->add('name', 'text',[
			'value' => $activity->activity_title
		])
		->add('description', 'textarea',[
			'value' => $activity->activity_desc
		])
		->add('image', 'file')
		->add('date', 'date',[
			'value' => $activity->activity_date
		])
		->add('id', 'hidden',[
			'value' => $id
		])
		->add('price', 'number',[
			'value' => $activity->activity_price
		])
		->add('type', 'choice',[
			'choices' => ['Punctual','Recurrent'],
			'multiple' => false,
			'expanded' => true,
			'selected' => $activity->activity_recurrence
		])
		->add('submit', 'submit',[
			'label' => 'Update'
		]);
	}
}
