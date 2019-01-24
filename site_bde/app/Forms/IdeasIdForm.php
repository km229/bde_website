<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\DB;

class IdeasIdForm extends Form
{
	public function buildForm()
	{
		$r = $_SERVER['REQUEST_URI']; 
		$id = explode('/', $r)[2];

		$this->formOptions = [
			'method' => 'POST',
			'url' => route('idea_update_check',['id'=>$id])
		];

		
		$table = DB::table('idea')->where('idea_id', $id)->get()[0];

		$this
		->add('name', 'text',[
			'value' => $table->idea_title
		])
		->add('description', 'textarea',[
			'value' => $table->idea_desc
		])
		->add('submit', 'submit');
	}
}
