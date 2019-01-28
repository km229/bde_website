@extends('template')

@section('title')
Administration
@endsection

@section('link')
<link rel="stylesheet/less" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('body')
<table id="table_id" class="display">
	<thead>
		<tr>
			<th>First name</th>
			<th>Last name</th>
			<th>E-mail</th>
			<th>State</th>
			<th>BDE Member</th>
			<th>Center</th>
		</tr>
	</thead>
	<tbody class="black">
		<?php

		foreach ($members as $member) {
			echo'<tr>';
			echo'<td>'.$member->member_firstname.'</td>';
			echo'<td>'.$member->member_lastname.'</td>';
			echo'<td>'.$member->member_mail.'</td>';
			echo'<td>'.$member->state_name.'</td>';
			echo'<td>'.$member->is_admin.'</td>';
			echo'<td>'.$member->location_center.'</td>';
			echo'</tr>';
		}

		?>
	</tbody>
</table>

@endsection

@section('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script>
	$(document).ready( function () {
		$('#table_id').DataTable();
	} );
</script>

@endsection