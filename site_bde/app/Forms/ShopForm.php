<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ShopForm extends Form
{
	public function buildForm()
	{
		$this->formOptions = [
			'method' => 'POST',
			'url' => route('shop_add_check')
		];

		$this
		->add('name', 'text')
		->add('description', 'textarea')
		->add('price', 'number')
		->add('category', 'text')
		->add('submit', 'submit');

	}
}
