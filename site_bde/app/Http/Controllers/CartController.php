<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


// Please specify your Mail Server - Example: mail.example.com.
ini_set("SMTP","smtp.gmail.com");

// Please specify an SMTP Number 25 and 8889 are valid SMTP Ports.
ini_set("smtp_port","587");

// Please specify the return address to use
ini_set('sendmail_from', 'cesibde@gmail.com');

error_reporting(-1);
ini_set('display_errors', 'On');



if(!isset($_SESSION)){
    session_start();
}

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('login');
    }

    public function index(){
        $id = $_SESSION['id'];
        $articles = DB::table('link_member_product_cart')->join('product','product_id_fk' ,'=','product_id')->get()->where('member_id_fk', $id);
        return view('cart', compact("articles"));
    }

    public function remove(){
        $r = $_SERVER['REQUEST_URI'];
        $id = explode('_', $r)[1];

        DB::table('link_member_product_cart')->where('member_id_fk','=', $_SESSION['id'])->where('product_id_fk','=', $id)->delete();

        return redirect(route('cart'));
    }

    public function increment(){
        $r = $_SERVER['REQUEST_URI'];
        $id = explode('_', $r)[1];

        $table = DB::table('link_member_product_cart')->get()->where('member_id_fk', $_SESSION['id'])->where('product_id_fk', $id);
        $index = $table->keys()[0];
        $quantity = $table[$index] -> number + 1;

        DB::table('link_member_product_cart')->where('member_id_fk', $_SESSION['id'])->where('product_id_fk', $id)->update(
            ['number' => $quantity ]
        );

        return redirect(route('cart'));
    }

    public function decrement(){
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

    public function buy(){

        $id = $_SESSION['id'];
        $member = DB::table('members')->get()->where('member_id', $id);
        $memberindex = $member->keys()[0];
        $cart = DB::table('link_member_product_cart')->join('product','product_id_fk' ,'=','product_id')->get()->where('member_id_fk', $id);
        $totalprice = 0;
        $date = date ('y-m-d-H\hi');

        foreach ($cart as $item){
            $totalprice += $item -> number * $item -> product_price;
            $salesnumber = $item -> product_sales_number + $item -> number;
            DB::table('product')->where('product_id', $item -> product_id)->update(
                array(
                    'product_sales_number' => $salesnumber
            ));
        }

        if ($totalprice == 0){
            return redirect(route('cart'));
        }


        DB::table('orders')->insert(
            array(
                'order_price' => $totalprice,
                'order_date' =>  $date,
                'member_id_fk' => $id
            )
        );
        $order = DB::table('orders')->get()->where('order_date',  $date)->where('member_id_fk', $id);
        $orderindex = $order->keys()[0];
        $orderid = $order[$orderindex] -> order_id;

        $message = "Hello ".$member[$memberindex] -> member_firstname.",\n\nThank you for purchasing on the CESI BDE's website. Here is a summary of your order n°".$orderid." :\n\n";

        foreach ($cart as $product){
            DB::table('link_orders_products')->insert(
                array(
                    'order_id_fk' => $orderid,
                    'product_id_fk' =>  $product -> product_id,
                    'number' => $product -> number,
                    'price' => $product -> product_price
                )
            );


            $productmsg = "{productname} : {quantity} x {price} € = {totalprice}€\n";
            $productmsg = str_replace('{productname}', $product -> product_name, $productmsg);
            $productmsg = str_replace('{quantity}', $product -> number, $productmsg);
            $productmsg = str_replace('{price}', $product -> product_price, $productmsg);
            $productmsg = str_replace('{totalprice}', ($product -> number * $product -> product_price), $productmsg);
            $message = $message.$productmsg;
        }

        $message = $message."\nTotal = ".$totalprice."€\n\nPlease contact us at this address so we can set a rendez-vous to process the payment and delivery.\n\nWe hope to see you again,\n\nCESI BDE's team.\n";
        DB::table('link_member_product_cart')->where('member_id_fk', $id)->delete();

        mail($member[$memberindex] -> member_mail, 'Thank you for your purchase !', $message);

        return redirect(route('cart'));
    }
}

