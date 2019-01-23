@extends('template')

@section('title')
My orders | Account
@endsection

@section('body')
<div class="row">
	<div class="col-lg-3">
		<h1 class="my-4">My account</h1>
		<div class="list-group card my-4 card-search">
			<h5 class="card-header black">Navigation</h5>
			<a href="/account/orders" class="list-group-item black">My orders</a>
			<a href="/account" class="list-group-item black">My informations</a>
		</div>
	</div>
	<div class="col-lg-9">
		<?php

		$test = DB::table('orders')->where('member_id_fk', $_SESSION['id'])->get();

		foreach ($test as $order) {
			echo'<br><div class="card">
			<div class="card-header black">
			<h5>Order '.$order->order_id.'</h5>
			<i>'.$order->order_date.'</i>
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
				<td>'.($el->product_price * $el->number).' €</td></tr>';
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


