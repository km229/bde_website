<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ActivitiesIdForm extends Form
{
    public function buildForm()
    {
        $this->formOptions = [
			'method' => 'POST',
			'url' => route('activities')
		];

		$table = DB::table('members')->get()->where('member_firstname', $_SESSION['name']);

		$index = $table->keys()[0];

		$member = $table[$index];

		$this
		->add('name', 'text',[
			'value' => $member->member_firstname
		])
		->add('description', 'textarea',[
			'value' => $member->member_lastname
		])
		->add('image', 'file')
		->add('date', 'date')
		->add('submit', 'submit',[
			'label' => 'Sign up'
		]);
    }
}
