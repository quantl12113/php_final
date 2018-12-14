@extends('layouts.frontLayout.front_design')

@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanks</li>
				</ol>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<h3>YOUR ORDER HAS BEEN PLACED</h3>
				<p>Your order number is {{ Session::get('order_id') }} and total payable about is $ {{ Session::get('grand_total') }}</p>
				<p>Please make payment by clicking on below Payment Button</p>
					<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  						<input type="hidden" name="cmd" value="_xclick">
  						<input type="hidden" name="business" value="votuan921-facilitator@gmail.com">
					 	<input type="hidden" name="item_name" value="{{ Session::get('order_id') }}">
					  	<input type="hidden" name="amount" value="{{ Session::get('grand_total') }}">
					  	<input type="hidden" name="currency_code" value="USD">
  						<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now">
					  	<img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection

<?php 
	Session::forget('grand_total');
	Session::forget('order_id');
?>s