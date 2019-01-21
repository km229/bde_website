<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

if(!isset($_SESSION)){
    session_start();
}

class CartController extends Controller
{
	public function index(){
        $id = $_SESSION['id'];
        $articles = DB::table('link_member_product_cart')->join('product','product_id_fk' ,'=','product_id')->get()->where('member_id_fk', $id);
        return view('cart', compact("articles"));
	}

	public function remove($article){
        $r = $_SERVER['REQUEST_URI'];
        $id = explode('_', $r)[1];

        $table = DB::table('link_member_product_cart')->get()->where('member_id_fk', $_SESSION['id'])->where('product_id_fk', $id);
        $index = $table->keys()[0];
        $quantity = $table[$index] -> number;
        if($quantity > 1){
            $quantity = $quantity - 1;
            DB::table('link_member_product_cart')->where('member_id_fk', $_SESSION['id'])->where('product_id_fk', $id)->update(
                ['number' => $quantity ]

            );
        }else{
            DB::table('link_member_product_cart')->where('member_id_fk','=', $_SESSION['id'])->where('product_id_fk','=', $id)->delete();
        }


        return redirect(route('cart'));
    }
}
