@extends('layouts.frontLayout.front_design')

@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li><a href="{{ url('orders') }}">Orders</a></li>
				  <li class="active">{{ $orderDetails->id }}</li>
				</ol>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
			        <thead>
			            <tr>
			                <th>Product Code</th>
			                <th>Product Name</th>
			                <th>Product Size</th>
			                <th>Product Color</th>
			                <th>Product Price</th>
			                <th>Product Qty</th>
			            </tr>
			        </thead>
			        @foreach($orderDetails->orders as $pro)
			        <tbody>
			            <tr>
			                <td>{{ $pro->product_code }}</td>
			                <td>{{ $pro->product_name }}</td>
			                <td>{{ $pro->product_size }}</td>
			                <td>{{ $pro->product_color }}</td>
			                <td>{{ $pro->product_price }}</td>
			                <td>{{ $pro->product_qty }}</td>
			            </tr>
			        </tbody>
			        @endforeach
    			</table>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection
