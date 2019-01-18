<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ShopCategoryForm extends Form
{
	public function buildForm()
	{
		$this->formOptions = [
			'method' => 'POST',
			'url' => route('shop_add_category_check')
		];

		$this
		->add('name', 'text')
		->add('submit', 'submit');

	}
}
