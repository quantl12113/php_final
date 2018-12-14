@extends('layouts.adminLayout.admin_design')
@section('content')
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders</a> </div>
    <h1>Orders {{ $orderDetails->id }}</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title">
            <h5>Order Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td class="taskDesc"><i class="icon-plus-sign"></i>Order Date</td>
                  <td class="taskStatus">{{ $orderDetails->created_at }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"><i class="icon-ok-sign"></i>Order Status</td>
                  <td class="taskStatus">{{ $orderDetails->order_status }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title">
                <h5>Billing Details</h5>
              </div> 
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content"><strong>Address</strong>: {{ $userDetails->address }}</div>
              <div class="widget-content"><strong>City</strong>: {{ $userDetails->city }}</div>
              <div class="widget-content"><strong>State</strong>: {{ $userDetails->state }}</div>
              <div class="widget-content"><strong>Country</strong>: {{ $userDetails->country }}</div>
              <div class="widget-content"><strong>Pincode</strong>: {{ $userDetails->pincode }}</div>
              <div class="widget-content"><strong>Mobile</strong>: {{ $userDetails->mobile }}</div>
            </div>
          </div>
        </div>
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title">
                <h5>Payment Details</h5>
              </div> 
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content"><strong>Payment Method</strong>: {{ $orderDetails->payment_method }}</div>
              <div class="widget-content"><strong>Shipping charges</strong>: {{ $orderDetails->shipping_charges }}</div>
              <div class="widget-content"><strong>Coupon Code</strong>: {{ $orderDetails->coupon_code }}</div>
              <div class="widget-content"><strong>Grand Total</strong>: {{ $orderDetails->grand_total }}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title">
            <h5>Customer Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td class="taskDesc"><i class="icon-plus-sign"></i>Customer Name</td>
                  <td class="taskStatus">{{ $orderDetails->name }}</td>
                </tr>
                <tr>
                  <td class="taskDesc"><i class="icon-ok-sign"></i>Customer Email</td>
                  <td class="taskStatus">{{ $orderDetails->user_email }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title">
                <h5>Shipping Details</h5>
              </div> 
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content"><strong>Address</strong>: {{ $shippingDetails->address }}</div>
              <div class="widget-content"><strong>City</strong>: {{ $shippingDetails->city }}</div>
              <div class="widget-content"><strong>State</strong>: {{ $shippingDetails->state }}</div>
              <div class="widget-content"><strong>Country</strong>: {{ $shippingDetails->country }}</div>
              <div class="widget-content"><strong>Pincode</strong>: {{ $shippingDetails->pincode }}</div>
              <div class="widget-content"><strong>Mobile</strong>: {{ $shippingDetails->mobile }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--main-container-part-->
@endsection