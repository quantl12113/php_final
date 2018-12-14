<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/', function () {
    return view('coming-soon');
});*/

Route::get('/','IndexController@index');

Route::match(['get', 'post'], '/admin','AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Category/Listing Page
Route::get('/products/{url}','ProductsController@products');

// Product Detail Page
Route::get('/product/{id}','ProductsController@product');

Route::get('/restaurant/{id}', 'RestaurantsController@viewRestaurant');

// Cart Page
Route::match(['get', 'post'],'/cart','ProductsController@cart');

// Add to Cart Route
Route::match(['get', 'post'], '/add-cart', 'ProductsController@addtocart');

// Delete Product from Cart Route
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');

// Update Product Quantity from Cart
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

// Get Product Attribute Price
Route::any('/get-product-price','ProductsController@getProductPrice');

// Apply Coupon
Route::post('/cart/apply-coupon','ProductsController@applyCoupon');

// Users Login/Register Page
Route::get('/login-register','UsersController@userLoginRegister');

Route::post('/user-register', 'UsersController@register');

Route::get('/user-logout','UsersController@logout'); 

Route::post('user-login','UsersController@login');
Route::group(['middleware' => ['frontlogin']], function() {
	Route::match(['get','post'],'account','UsersController@account');
	Route::post('/check-user-pwd','UsersController@chkUserPassword');
	Route::post('/update-user-pwd','UsersController@updatePassword');
	Route::match(['get','post'],'checkout','ProductsController@checkout');
	Route::match(['get','post'],'/order-review','ProductsController@orderReview');
	Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
	Route::get('/thanks','ProductsController@thanks');
	Route::get('/paypal','ProductsController@paypal');
	Route::get('/orders','ProductsController@userOrders');
	Route::get('/orders/{id}','ProductsController@userOrderDetails');
	Route::match(['get', 'post'], '/comment-review', 'ProductsController@commentReview');
});

Route::match(['GET','POST'],'/check-email','UsersController@checkEmail');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/admin/dashboard','AdminController@dashboard');	
	Route::get('/admin/settings','AdminController@settings');
	Route::get('/admin/check-pwd','AdminController@chkPassword');
	Route::match(['get', 'post'],'/admin/update-pwd','AdminController@updatePassword');

	// Admin Categories Routes
	Route::match(['get', 'post'], '/admin/add-category','CategoryController@addCategory');
	Route::match(['get', 'post'], '/admin/edit-category/{id}','CategoryController@editCategory');
	Route::match(['get', 'post'], '/admin/delete-category/{id}','CategoryController@deleteCategory');
	Route::get('/admin/view-categories','CategoryController@viewCategories');

	// Admin Products Routes
	Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
	Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
	Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');
	Route::get('/admin/view-products','ProductsController@viewProducts');
	Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
	
	Route::match(['get', 'post'], '/admin/add-images/{id}','ProductsController@addImages');
	Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteProductAltImage');

	// Admin Attributes Routes
	Route::match(['get', 'post'], '/admin/add-attributes/{id}','ProductsController@addAttributes');
	Route::match(['get', 'post'], '/admin/edit-attributes/{id}','ProductsController@editAttributes');
	Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttribute');

	// Admin Coupon Routes
	Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
	Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
	Route::get('/admin/view-coupons','CouponsController@viewCoupons');
	Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');

	// Admin Banners Routes
	Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');
	Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
	Route::get('admin/view-banners','BannersController@viewBanners');
	Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');

	Route::get('/admin/view-orders','ProductsController@viewOrders');
	Route::get('/admin/view-users','UsersController@viewUsers');
	Route::get('/admin/view-order/{id}','ProductsController@viewOrderDetails');
	Route::get('/admin/view-user/{id}','UsersController@viewUserDetails');
	Route::match(['post'], '/admin/view-orders/update-status','ProductsController@updateStatus');
	Route::match(['post'], '/admin/view-users/update-permision','UsersController@updatePermision');
});


Route::get('/logout','AdminController@logout');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
