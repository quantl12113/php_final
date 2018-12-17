<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReviewsComment;
use App\ReviewsImage;
use Image;
use Auth;
use File;
function reArrayFiles(&$file_post) {

	    $file_ary = array();
	    $file_count = count($file_post['name']);
	    $file_keys = array_keys($file_post);

	    for ($i=0; $i<$file_count; $i++) {
	        foreach ($file_keys as $key) {
	            $file_ary[$i][$key] = $file_post[$key][$i];
	        }
	    }

	    return $file_ary;
	}
class ReviewsController extends Controller
{
	


    public function commentReview(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            $user_id = Auth::user()->id;
            $product_id = $data['product_id'];
            $comment = new ReviewsComment;
            $comment->user_id = $user_id;
            $comment->name = Auth::user()->name;
            $comment->review_point = $data['review_point'];
            $comment->title = $data['title'];
            $comment->product_id = $product_id;
            $comment->description = $data['description'];
            $comment->save();
            if($request->hasFile('photo')){
            	$images = $request->file('photo');
            	foreach ($images as $image_tmp) {
                    if($image_tmp->isValid()) {
	                    $extension = $image_tmp->getClientOriginalExtension();
		                $fileName = rand(111,99999).'.'.$extension;
  
	                    $small_image_path = 'images/backend_images/product/small'.'/'.$fileName;  

	     				Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
	     				$review_image = new ReviewsImage;
	     				$review_image->comment_id = $comment->id;
                        $review_image->product_id = $product_id;
	     				$review_image->image = $fileName;
	     				$review_image->save();
                    }
            	}
            }
        }
    }
}
