@extends('layouts.adminLayout.admin_design')
@section('content')
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Users</a> </div>
    <h1>User No.{{ $userDetails->id }}</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span6">
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title">
                <h5>User Details</h5>
              </div> 
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content"><strong>ID</strong>: {{ $userDetails->id }}</div>
              <div class="widget-content"><strong>Name</strong>: {{ $userDetails->name }}</div>
              <div class="widget-content"><strong>Join Date</strong>: {{ $userDetails->created_at }}</div>
              <div class="widget-content"><strong>Email</strong>: {{ $userDetails->email }}</div>
              <div class="widget-content"><strong>Address</strong>: {{ $userDetails->address }}</div>
              <div class="widget-content"><strong>City</strong>: {{ $userDetails->city }}</div>
              <div class="widget-content"><strong>State</strong>: {{ $userDetails->state }}</div>
              <div class="widget-content"><strong>Country</strong>: {{ $userDetails->country }}</div>
              <div class="widget-content"><strong>Pincode</strong>: {{ $userDetails->pincode }}</div>
              <div class="widget-content"><strong>Mobile</strong>: {{ $userDetails->mobile }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--main-container-part-->
@endsection