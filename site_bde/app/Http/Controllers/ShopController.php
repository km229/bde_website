<?php

namespace App\Http\Controllers;

use App\Forms\ShopForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //
    public function index(){
        return view('shop.shop');
    }

    public function add(FormBuilder $formbuilder){
		$form = $formbuilder->create(ShopForm::class);
		return view('shop.shop_add', compact('form'));
	}

	 public function add_check(){
		if(!empty($_POST)){

            DB::table('product')->insert(
                array(
                    'product_name' => $_POST['name'],
                    'product_desc' => $_POST['description'],
                    'product_price' => $_POST['price']
                )
            );
            return redirect(route('shop'));
        }
	}
}
