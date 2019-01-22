<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\DB;

if(!isset($_SESSION)){
	session_start();
}

class ShopIdForm extends Form
{
	public function buildForm()
	{

		$r = $_SERVER['REQUEST_URI']; 
		$id = explode('/', $r)[2];

		$this->formOptions = [
			'method' => 'POST',
			'url' => route('shop_id_update_check')
		];

		$table = DB::table('product')->get()->where('product_id', $id);

		$index = $table->keys()[0];



		$product = $table[$index];

		$this
		->add('name', 'text',[
			'value' => $product->product_name
		])
		->add('description', 'textarea',[
			'value' => $product->product_desc
		])
		->add('image', 'file')
		->add('price', 'number',[
			'value' => $product->product_price
        ])
        ->add('id', 'hidden',[
			'value' => $id
		])
		->add('submit', 'submit',[
			'label' => 'Update'
		]);
	}
}
