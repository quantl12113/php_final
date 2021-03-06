@extends('layouts.frontLayout.front_design')

@section('content')

<section>
		<div class="container">
			<div class="row">
			@if(Session::has('flash_message_error'))
	            <div class="alert alert-error alert-block" style="background-color:#d7efe5">
	                <button type="button" class="close" data-dismiss="alert">×</button> 
	                    <strong>{!! session('flash_message_error') !!}</strong>
	            </div>
	        @endif   
				<div class="col-sm-3">
					@include('layouts.frontLayout.front_sidebar')	
				</div>
				
				<div class="col-sm-9 padding-right">

					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
								<a id="mainImgLarge" href="{{ asset('/images/backend_images/product/large/'.$productDetails->image) }}">
									<img style="width:300px" id="mainImg" src="{{ asset('/images/backend_images/product/medium/'.$productDetails->image) }}" alt="" />
								</a>
								</div>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										@if(count($productAltImages)>0)
										<div class="item active thumbnails">
												@foreach($productAltImages as $altimg)
													<a href="{{ asset('images/backend_images/product/medium/'.$altimg->image) }}" data-standard="{{ asset('images/backend_images/product/small/'.$altimg->image) }}">
										  				<img class="changeImage" style="width:80px; cursor:pointer" src="{{ asset('images/backend_images/product/small/'.$altimg->image) }}" alt="">
													</a>
												@endforeach
										</div>
										@endif
									</div>

								  <!-- Controls -->
								  <!-- <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a> -->
							</div>

						</div>
						<div class="col-sm-7">
							<form name="addtoCartForm" id="addtoCartForm" action="{{ url('add-cart') }}" method="post">{{ csrf_field() }}
		                        <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
		                        <input type="hidden" name="product_name" value="{{ $productDetails->product_name }}">
		                        <input type="hidden" name="product_code" value="{{ $productDetails->product_code }}">
		                        <input type="hidden" name="product_color" value="{{ $productDetails->product_color }}">
		                        <input type="hidden" name="price" id="price" value="{{ $productDetails->price }}">
								<div class="product-information"><!--/product-information-->
									<img src="images/product-details/new.jpg" class="newarrival" alt="" />
									<h2>{{ $productDetails->product_name }}</h2>
									<p>Product Code: {{ $productDetails->product_code }}</p>
									<p>
										<select id="selSize" name="size" style="width:150px;" required>
											<option value="">Select</option>
											@foreach($productDetails->attributes as $sizes)
											<option value="{{ $productDetails->id }}-{{ $sizes->size }}">{{ $sizes->size }}</option>
											@endforeach
										</select>	
									</p>
									<img src="images/product-details/rating.png" alt="" />
									<span>
										<span id="getPrice">$ {{ $productDetails->price }}</span>
										<label>Quantity:</label>
										<input name="quantity" type="text" value="1" />
										@if($total_stock>0)
											<button type="submit" class="btn btn-fefault cart" id="cartButton">
												<i class="fa fa-shopping-cart"></i>
												Add to Cart
											</button>
										@endif	
									</span>
									<p><b>Availability: </b><span id="Availability"> @if($total_stock>0) In Stock @else Out Of Stock @endif</span></p>
									<p><b>Condition:</b> New</p>
			
									<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
								</div><!--/product-information-->
							</form>
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
								<li><a href="#care" data-toggle="tab">Material & Care</a></li>
								<li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
								<li><a href="#reviews" data-toggle="tab">Review({{ count($review_comments) }})</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="description" >
								<div class="col-sm-12">
									<p>{{ $productDetails->description }}</p>
								</div>	
							</div>
							
							<div class="tab-pane fade" id="care" >
								<div class="col-sm-12">
									<p>{{ $productDetails->care }}</p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="delivery" >
								<div class="col-sm-12">
									<p>100% Original Products <br>
									Cash on delivery might be available</p>
								</div>
							</div>

							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									@if(count($review_comments)>0)
										@foreach($review_comments as $review)
											<?php 
												$date = date_create($review->updated_at);
											?>
											<ul>
												<li><a href=""><i class="fa fa-user"></i>{{$review->name}}</a></li>
												<li><a href=""><i class="fa fa-clock-o"></i>{{ date_format($date, 'H:i') }}</a></li>
												<li><a href=""><i class="fa fa-calendar-o"></i>{{ date_format($date, "d/m/Y") }}</a></li>
											</ul>
											<h4>{{ $review->title }}</h4>
											<?php
												
											?>
											@foreach($review_images as $images)
												@if($images->comment_id == $review->id)
													<img style="width:100px; height: 100px;" src="{{ asset('images/backend_images/product/small/'.$images->image) }}" alt="" />
												@endif
											@endforeach
											
											<p>{{ $review->description }}</p>
										@endforeach
									@endif	
								</div>
								<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Comment</button>
								<div class="modal fade" id="myModal" role="dialog" style="width: 650px; height: 420px; background-color: white">
									<div class="modal-dialog">
        									<button type="button" class="close" data-dismiss="modal">&times;</button>
        									<h4 class="modal-title">Write review</h4>
										<div class="modal-body">
										<form action="{{ url('comment-review') }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
											{{ csrf_field() }}
											<input type="hidden" name="product_id" value="{{ $productDetails->id }}">
											<textarea style="height: 30px; background-color: #f7f7a9; margin-bottom: 5px; padding-top: 5px; font-weight: bold;" name="title" placeholder="Title"></textarea>
											<textarea style="height: 150px; background-color: #f7f7a9; margin-bottom: 10px; margin-top: 5px;" name="description" placeholder="Write your review"></textarea>
											<div>	                	
								            	<div class="pupload" id="pupload" style="background-color: #d6d6cd;">
								            		<i style="color: #0090f2;" class="fa fa-camera"></i>
								            		<label>Add Images</label>
								            	</div>
								            	<input type="file" id="files" name="photo[]" multiple />

									        </div>
									        <span></span>
											<div class="slidecontainer">
												<b>Rating: </b> 
  												<input style="width: 100px" type="range" min="0" max="10" value="5" class="slider" id="review_point" name="review_point">
  												<b id="point"></b><i class="fa fa-star"></i>
											</div>
											<button type="submit" class="btn btn-default pull-right">
												Comment
											</button>
										</form>
									</div>
									</div>
								</div>
		

							</div>

					
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<?php $count=1; ?>
								@foreach($relatedProducts->chunk(3) as $chunk)
								<div <?php if($count==1){ ?> class="item active" <?php } else { ?> class="item" <?php } ?>>	
									@foreach($chunk as $item)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="width:200px;" src="{{ asset('images/backend_images/product/small/'.$item->image) }}" alt="" />
													<h2>$ {{ $item->price }}</h2>
													<p>{{ $item->product_name }}</p>
													<a href="{{ url('/product/'.$item->id) }}"><button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Product</button></a>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								<?php $count++; ?>
								@endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>	

@endsection