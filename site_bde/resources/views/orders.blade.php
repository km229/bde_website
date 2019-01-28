@extends('template')

@section('title')
My orders | Account
@endsection

@section('body')
<div class="row">
	<div class="col-lg-3">
		<h1>My account</h1>
		<div class="list-group card my-4 card-search">
			<h5 class="card-header black">Navigation</h5>
			<a href="/account" class="list-group-item black">My informations</a>
			<a href="/account/orders" class="list-group-item black">My orders</a>
			<a href="/logout" class="list-group-item black">Logout</a>
		</div>
		<?php 
		if(isset($_SESSION)){
			$admin = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			if(!empty($admin[0]) && $admin[0]->is_admin===1){
				echo '<div class="list-group card my-4 card-search"><a href="/admin" class="list-group-item black">Administration</a></div>';
			}
		}
		?>
	</div>
	<div class="col-lg-9">
		<h2>My orders</h2>
		<?php

		$test = DB::table('orders')->where('member_id_fk', $_SESSION['id'])->get();

		foreach ($test as $order) {
			$date_explode = explode("-", $order->order_date);

			$date = $date_explode[2].'/'.$date_explode[1].'/'.$date_explode[0].' at '.$date_explode[3];

			echo'<br><div class="card">
			<div class="card-header black">
			<h5>Order '.$order->order_id.'</h5>
			<i>'.$date.'</i>
			</div>
			<table class="table table-striped table-hover table-bordered black">
			<tbody>
			<tr>
			<th>Item</th>
			<th>QTY</th>
			<th>Unit Price</th>
			<th>Total Price</th>
			</tr>
			';
			$test2 = DB::table('orders')->join('link_orders_products','order_id','=','order_id_fk')->where('member_id_fk', $_SESSION['id'])->where('order_id', $order->order_id)->join('product','product_id_fk','=','product_id')->get();

			foreach ($test2 as $el) {
				echo '<tr>
				<td>'.$el->product_name.'</td>
				<td>x'.$el->number.'</td>
				<td>'.$el->product_price.' €</td>
				<td>'.$el->price.' €</td></tr>';
			}
			echo'
			
			<tr>
			<th colspan="3"><span class="pull-right">Total</span></th>
			<th>'.$order->order_price.' €</th>
			</tr>

			</tbody>
			</table>
			</div>';
		}

		?>
	</div>
</div>
<div class="row">




	<!-- /.col-lg-3 -->

</div>
<!-- /.row -->
@endsection


