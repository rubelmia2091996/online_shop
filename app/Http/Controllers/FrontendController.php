<?php

namespace App\Http\Controllers;
use App\Models\catagory;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\color;
use App\Models\size;
use App\Models\attribute;
use App\Models\gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Image;

class FrontendController extends Controller
{
    function frontend(){
        return view('frontend.main',[
            'products' => Product::all(),
        ]);
    }
    function productDetails($slug){
        return view('frontend.pages.singleproduct',[
            'product' => Product::where('slug',$slug)->first()
        ]);
        // return view('frontend.pages.singleproduct');
    }
    function sizecolordetails($color_id,$product_id){
        $output="";
        $sizes = attribute::with(['Product','color','size'])->where('product_id',$product_id)->where('color_id',$color_id)->get();
        foreach ($sizes as $size) {
            $output= $output.'<input name="size" type="radio" data-quantity="'.$size->quantity.'"data-price="'.$size->regular_price.'"class="sizecheck" id="size" value="'.$size->id.'"><label for="size">'.$size->size->size_name.'</label>';
        }
        echo $output;
    }
}
