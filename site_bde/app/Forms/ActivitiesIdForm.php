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
			'url' => route('activities')
		];

		$table = DB::table('activity')->get()->where('activity_id', $id);

		$activity = $table[0];

		$this
		->add('name', 'text',[
			'value' => $activity->activity_title
		])
		->add('description', 'textarea',[
			'value' => $activity->activity_desc
		])
		->add('image', 'file',[
			'value' => $activity->activity_img
		])
		->add('date', 'date',[
			'value' => $activity->activity_date
		])
		->add('submit', 'submit',[
			'label' => 'Update'
		]);
	}
}
