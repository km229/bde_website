<?php

namespace App\Http\Controllers;


use App\Forms\ShopProductForm;
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

        return view('shop.shop', compact("products"), compact("category"));
    }

    public function add_product(FormBuilder $formbuilder){
        $form = $formbuilder->create(ShopProductForm::class);
        return view('shop.shop_add_product', compact('form'));
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
                    'product_img' => file_get_contents($_FILES['image']['tmp_name'])
                )
            );
            return redirect(route('shop'));
        }
    }

    public function add_category(FormBuilder $formbuilder){
        $form = $formbuilder->create(ShopCategoryForm::class);
        return view('shop.shop_add_category', compact('form'));
    }

    public function add_category_check(){
        DB::table('category')->insert(
            array(
                'category_name' => $_POST['name']));
        return redirect(route('shop'));
    }

    public function add_to_cart($id){
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
        return redirect(route('shop'));
    }

    public function id ($id){
        return view('shop.shop_id');
    }
}
