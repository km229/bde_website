<?php

namespace App\Http\Controllers;


use App\Forms\ShopProductForm;
use App\Forms\ShopCategoryForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //
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
                    'category_id_fk' => $cat
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


}
