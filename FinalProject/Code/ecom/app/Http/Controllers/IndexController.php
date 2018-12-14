<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Banner;

class IndexController extends Controller
{
    public function index(){
        $productsAll = null;
    	// Get all Products
        if ($_GET != null){
            $names = explode(" ",$_GET["find_name"]);
            $productsAll = null;
            $productsAll = Product::where('status',1)->where(function ($query) use($names) {
                for ($i = 0; $i < count($names); $i++) {
                    if ($names[$i] != null) {
                        $query->orwhere('product_name', 'like', '%' . $names[$i] . '%');
                    }
                }
                if(!empty($_GET["sprice"]) || !empty($_GET["eprice"])) {
                    $sprice = $_GET["sprice"] != null ? $_GET["sprice"] : 0;
                    $eprice = $_GET["eprice"] != null ? $_GET["eprice"] : 100000;
                    if ($sprice > $eprice) {
                        $tmp = $sprice;
                        $sprice = $eprice;
                        $eprice = $tmp;
                    }
                    $query->where('price', '>=', $sprice)->where('price', '<=', $eprice);
                }
                if(!empty($_GET["sort_type"])) {
                    if ($_GET["sort_type"] == "Descending") {
                        $query->orderBy('price', 'DESC');
                    } else {
                        $query->orderBy('price', 'ASC');
                    }
                }
            })->get();
        }
        else {
            $productsAll = Product::inRandomOrder()->where('status',1)->get();
        }
    	//$productsAll = Product::inRandomOrder()->where('status',1)->get();
        //$productsAll = Product::inRandomOrder()->where('product_name', 'like', '%green%')->get();
    	$productsAll = json_decode(json_encode($productsAll));
    	/*echo "<pre>"; print_r($productsAll);die;*/


    	// Get All Categories and Sub Categories
    	$categories_menu = "";
    	$categories = Category::with('categories')->where(['parent_id' => 0])->get();
    	$categories = json_decode(json_encode($categories));
    	/*echo "<pre>"; print_r($categories); die;*/
		foreach($categories as $cat){
			$categories_menu .= "
			<div class='panel-heading'>
				<h4 class='panel-title'>
					<a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
						<span class='badge pull-right'><i class='fa fa-plus'></i></span>
						".$cat->name."
					</a>
				</h4>
			</div>
			<div id='".$cat->id."' class='panel-collapse collapse'>
				<div class='panel-body'>
					<ul>";
					$sub_categories = Category::where(['parent_id' => $cat->id])->get();
					foreach($sub_categories as $sub_cat){
						$categories_menu .= "<li><a href='#'>".$sub_cat->name." </a></li>";
					}
						$categories_menu .= "</ul>
				</div>
			</div>
			";		
		}

		$banners = Banner::where('status','1')->get();

    	return view('index')->with(compact('productsAll','categories_menu','categories','banners'));
    }
}
