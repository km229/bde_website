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
		$products = DB::table('product')->paginate(9);
		$links = $products->render();
		$category = DB::table('category')->get();

		return view('shop.shop', compact("products", "category", "links"));
	}

	public function search(){
		if(isset($_GET['request'])){
			$_SESSION['request']=$_GET['request'];
		}
		$search=$_SESSION['request'];
		$products = DB::table('product')->whereRaw("product_name REGEXP '".$search."' OR product_desc REGEXP '".$search."'")->paginate(9);
		$verif_product = DB::table('product')->whereRaw("product_name REGEXP '".$search."' OR product_desc REGEXP '".$search."'")->get();
		$links = $products->render();
		$category = DB::table('category')->get();
		return view('shop.research', compact("products", "links", "search", "verif_product", "category"));
	}

	public function add_product(FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			if($table[0]->is_admin == 1){
				$form = $formbuilder->create(ShopProductForm::class);
				return view('shop.shop_add_product', compact('form'));
			}
		}
		return redirect(route('shop'))->with('error', 'You are not allowed to add a category');
	}

	public function add_product_check(){
		if(!empty($_POST)){

			if(sizeof($_SESSION) > 0){
				$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
				if($table[0]->is_admin == 1){
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
					return redirect(route('shop'))->with('success', 'Product "'.$_POST['name'].'" added !');
				}
			}
			return redirect(route('shop'))->with('error', 'You are not allowed to add a product');

		}
		return redirect(route('shop'))->with('error', 'Error, try again');
	}

	public function add_category(FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			if($table[0]->is_admin == 1){
				$form = $formbuilder->create(ShopCategoryForm::class);
				return view('shop.shop_add_category', compact('form'));
			}
		}
		return redirect(route('shop'))->with('error', 'You are not allowed to add a category');
	}

	public function add_category_check(){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			if($table[0]->is_admin == 1){
				return redirect(route('shop'))->with('success', 'Category "'.$_POST['name'].'" added !');
			}
		}
		return redirect(route('shop'))->with('error', 'You are not allowed to add a category');
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

			$articles = DB::table('link_member_product_cart')->join('product', 'product_id', '=', 'product_id_fk')->where('member_id_fk', $_SESSION['id'])->where('product_id_fk', $id)->get();
			return redirect(route('shop'))->with('success', 'Product "'.$articles[0]->product_name.'" added to cart !');
		}
		return redirect(route('shop'))->with('error', 'You must be connected before to purchase products.');
	}

	public function id ($id){
		return view('shop.shop_id', compact('id'));
	}

	public function id_update($id, FormBuilder $formbuilder){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			if($table[0]->is_admin == 1){
				$form = $formbuilder->create(ShopIdForm::class);
				return view('shop.shop_add_product', compact('form'));
			}
		}
		return back()->with('error', 'You are not allowed to update a product');
	}

	public function id_update_check(){
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			if($table[0]->is_admin == 1){

				if($_FILES['image']['tmp_name'] === ""){
					DB::table('product')
					->where('product_id',$_POST['id'])
					->update(['product_name' => $_POST['name'],'product_desc' => $_POST['description'],'product_price' => $_POST['price']]);
				}else {
					DB::table('product')
					->where('product_id',$_POST['id'])
					->update(['product_name' => $_POST['name'],'product_desc' => $_POST['description'],'product_img' => file_get_contents($_FILES['image']['tmp_name']),'product_price' => $_POST['price']]);
				}
				return redirect(route('shop'))->with('success', 'Product "'.$_POST['name'].'" updated !');

			}
		}
		return redirect(route('shop'))->with('error', 'You are not allowed to update a product');
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
				$product=DB::table('product')->where('product_id',$id)->get();
				DB::table('product')
				->where('product_id',$id)
				->delete();
				return redirect(route('shop'))->with('success', 'Product "'.$product[0]->product_name.'" deleted !');
			}
		}

		return back()->with('error', 'You are not allowed to delete a product');
	}
}
