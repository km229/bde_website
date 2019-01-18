<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\DB;

class ShopProductForm extends Form
{
	public function buildForm()
	{
		$this->formOptions = [
			'method' => 'POST',
			'url' => route('shop_add_product_check')
		];

		$db = DB::table('category')->get();
		$array = [];
        foreach($db as $choice){
            $array[] = $choice;

        }
        $table = [];

        for($i = 0; $i < sizeof($array); $i++){
            $table[] =  $array[$i] -> category_name;
        }





		$this
		->add('name', 'text')
		->add('description', 'textarea')
		->add('price', 'number')
		->add('category', 'choice', [
		    'choices' => $table
        ])
		->add('submit', 'submit');

	}
}
