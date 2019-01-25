<?php

namespace App\Http\Controllers;


use App\Forms\ShopProductForm;
use App\Forms\ShopIdForm;
use App\Forms\ShopCategoryForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;


if(!isset($_SESSION)){
	session_start();
}

class ShopController extends Controller
{
	public function index(){
		$products = DB::table('product')->get();
		$category = DB::table('category')->get();


        $bestsellers = DB::table('product')->orderBy('product.product_sales_number', 'DESC')->limit(3)->get();

		return view('shop.shop', compact("products"), compact("category"));
	}

	public function add_product(FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->get()->where('member_id', $_SESSION['id']);
			$index = $table->keys()[0];
			if($table[$index]->is_admin == 1){
				$form = $formbuilder->create(ShopProductForm::class);
				return view('shop.shop_add_product', compact('form'));
			}
		}
		return redirect(route('shop'));
	}

	public function add_product_check(){



		if(!empty($_POST)){

			$cat = $_POST['category']+1;
			DB::table('product')->insert(
				array(
					'product_name' => $_POST['name'],
					'product_desc' => $_POST['description'],
					'product_price' => $_POST['price'],
					'category_id_fk' => $cat,
					'product_img' => file_get_contents($_FILES['image']['tmp_name']),
                    'product_sales_number' => 0
				)
			);
			return redirect(route('shop'))->with('success', 'Product added');
		}
	}

	public function add_category(FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->get()->where('member_id', $_SESSION['id']);
			$index = $table->keys()[0];
			if($table[$index]->is_admin == 1){
				$form = $formbuilder->create(ShopCategoryForm::class);
				return view('shop.shop_add_category', compact('form'));
			}
		}
		return redirect(route('shop'));
	}

	public function add_category_check(){
		DB::table('category')->insert(
			array(
				'category_name' => $_POST['name']));
		return redirect(route('shop'))->with('success', 'Category added');
	}

	public function add_to_cart($id){
		if(sizeof($_SESSION) > 0){
			$test = DB::table('link_member_product_cart')->get()->where('member_id_fk', $_SESSION['id'])->where('product_id_fk', $id);
        //dd($test);

			if(sizeof($test) == 0){
				DB::table('link_member_product_cart')->insert(
					array(
						'member_id_fk' => $_SESSION['id'],
						'product_id_fk' => $id,
						'number' => 1,
					)
				);
			}else{
				$index = $test->keys()[0];
				$quantity = $test[$index] -> number + 1;
				DB::table('link_member_product_cart')->where('member_id_fk', $_SESSION['id'])->where('product_id_fk', $id)->update(
					array(
						'number' => $quantity,
					)
				);
			}

			$articles = DB::table('link_member_product_cart')->get()->where('member_id_fk', $_SESSION['id']);
			return redirect(route('shop'))->with('success', 'Product added to cart');
		}
	}

	public function id ($id){
		return view('shop.shop_id', compact('id'));
	}

	public function id_update($id, FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->get()->where('member_id', $_SESSION['id']);
			$index = $table->keys()[0];

			if($table[$index]->is_admin == 1){
				$form = $formbuilder->create(ShopIdForm::class);
				return view('shop.shop_add_product', compact('form'));
			}
		}
		return redirect(route('shop'));
	}

	public function id_update_check(){
		if($_FILES['image']['tmp_name'] === ""){
			DB::table('product')
			->where('product_id',$_POST['id'])
			->update(['product_name' => $_POST['name'],'product_desc' => $_POST['description'],'product_price' => $_POST['price']]);
		}else{
			DB::table('product')
			->where('product_id',$_POST['id'])
			->update(['product_name' => $_POST['name'],'product_desc' => $_POST['description'],'product_img' => file_get_contents($_FILES['image']['tmp_name']),'product_price' => $_POST['price']]);
		}
		return redirect(route('shop'))->with('success', 'product updated');
	}

	public function delete($id){

		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

			if($table[0]->is_admin == 1){       
				DB::table('link_member_product_cart')
				->where('product_id_fk',$id)
				->delete();

				DB::table('link_orders_products')
				->where('product_id_fk',$id)
				->delete();

				DB::table('product')
				->where('product_id',$id)
				->delete();
				return redirect(route('shop'))->with('success', 'Product deleted');
			}
		}

		return redirect(route('shop'))->with('error', 'You don\'t have access !');
	}
}
