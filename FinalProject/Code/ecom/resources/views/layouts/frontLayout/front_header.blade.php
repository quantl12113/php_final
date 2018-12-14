<?php use App\Http\Controllers\Controller;
$mainCategories =  Controller::mainCategories();
?>
<header id="header"><!--header-->
		
		<div class="header-middle navbar" style="position: fixed; top: 0;width: 100%;z-index: 100;background-color: white;"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="logo pull-left">
							<a href="{{ url('/') }}"><img src="{{ asset('images/frontend_images/home/logo.png') }}" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-5">

						<form action="" method="get">
							<input type="text" name="find_name" style="border-radius: 33px; width: 300px; margin-top: 10px; margin-left: 10px; height: 30px" placeholder="Search"/>
                    	</form>
                    </div>
					<div class="col-sm-5">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<!-- <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li> -->
								<li><a href="{{ url('/orders') }}"><i class="fa fa-crosshairs"></i> Orders</a></li>
								<li><a href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								@if(empty(Auth::check()))
									<li><a href="{{ url('/login-register') }}"><i class="fa fa-lock"></i> Login</a></li>
								@else
									<li><a href="{{ url('/account') }}"><i class="fa fa-user"></i> Account</a></li>
									<li><a href="{{ url('/user-logout') }}"><i class="fa fa-user"></i> Logout</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom" style="margin-top: 100px;"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ url('/') }}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    	@foreach($mainCategories as $cat)
                                        	<li><a href="{{ asset('products/'.$cat->url) }}">{{ $cat->name }}</a></li>
										@endforeach
                                    </ul>
                                </li> 
                                </li> 
								<li><a href="#">Contact</a></li>
							</ul>
						</div>
					</div>
                    
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->