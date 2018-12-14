<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantsController extends Controller
{
    public function viewRestaurant($id) {
    	$restaurantDetails = Restaurant::where('id', $id)->get();
    	$restaurantDetails = json_decode(json_encode($restaurantDetails));
    	echo "<pre>"; print_r($restaurantDetails); die;
    }
}
