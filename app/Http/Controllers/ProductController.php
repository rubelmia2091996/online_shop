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

class ProductController extends Controller
{
    function addproducts(){
        return view('backend.products.products_add',[
            'category'=> catagory::all(),
            'colors'=> color::all(),
            'sizes'=> size::all()
        ]);
    }
    function ajaxsubcat($id)
    {
        $sub_cat = SubCategory::where('catagories_id', $id)->get();
        return response()->json($sub_cat);
    }
    function postProducts(Request $request){
        
        $request->validate([
            'thumbnail'=>['required', 'mimes:png,jpg,bmp,jpeg'],
            // another way of an array
            'slug' => 'required|unique:products',
        ]);

        $product= new Product;
        $product->tittle = $request->tittle;
        $product->slug=$request->slug;
        $product->category_id=$request->category_id;
        $product->subCategory_id=$request->subcategory_id;
        // $product->thumbnail=$request->thumbnail;
        $product->description =$request->description;
        $product->summary=$request->summary;
        if($request->hasFile('thumbnail')){
            $image=$request->file('thumbnail');
            $ext=str::random(5).'-'.$request->slug.'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('thumbnail/'.$ext),70);
            $product->thumbnail=$ext;
        }
        $product->save();

        if($request->hasFile('image_name')){
            $image1=$request->file('image_name');
            foreach ($image1 as $key => $imageValue) {
            $ext1=str::random(10).'gallaryimage'.$request->slug.'.'.$imageValue->getClientOriginalExtension();
            Image::make($imageValue)->save(public_path('gallery/'.$ext1),70);
            $gallery= new gallery;
            $gallery->image_name= $ext1;
            $gallery->product_id=$product->id;
            $gallery->save();
            } 
            
        }

        foreach ($request->colors_id as $key=>$color){
            $attributes= new attribute;
            $attributes->product_id= $product->id;
            $attributes->color_id=$color;
            $attributes->size_id=$request->sizes_id[$key];
            $attributes->quantity=$request->quantity[$key];
            $attributes->regular_price=$request->regular_price[$key];
            $attributes->sale_price=$request->sale_price[$key];
            $attributes->save();
        }
        return back();
    }


    function viewProducts(){
        return view('backend.products.product_view',[
            'products'=> Product::paginate(50),
        ]);
    }
    function editProduct($slug){
        $products = Product::where('slug',$slug)->first();
        return view('backend.products.product_update',[
            'product'=> $products,
            'category'=> catagory::all(),
            'colors'=> color::all(),
            'sizes'=> size::all(),
            'subCategory'=> SubCategory::where('catagories_id',$products->category_id)->get(),
            'attributes'=> attribute:: where('product_id',$products->id)->get(),
            'gallaries'=> gallery:: where('product_id',$products->id)->get()
            
        ]);

    }
    function updatedproduct(Request $request){
        $product= Product::findOrFail($request->product_id);
        $product_slug=$request->slug;
        $old_img=public_path('thumbnail/'.$product->thumbnail);
        $request->validate([
            'thumbnail'=>['mimes:png,jpg,bmp,jpeg']
        ]);
        $product->tittle = $request->tittle;
        $product->slug=$request->slug;
        $product->category_id=$request->category_id;
        $product->subCategory_id=$request->subcategory_id;
        $product->description =$request->description;
        $product->summary=$request->summary;
        if($request->hasFile('thumbnail')){
            if(file_exists($old_img)){
                unlink($old_img);
            }
            $image=$request->file('thumbnail');
            $ext=str::random(5).'-'.$request->slug.'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path('thumbnail/'.$ext),70);
            $product->thumbnail=$ext;
        }
        $product->save();
        foreach ( $request->attribute_id as $key => $attribute_id) {
                if($attribute_id!=""){
                $attribute= attribute::findorfail($attribute_id);
                $attribute->color_id = $request->colors_id[$key];
                $attribute->size_id = $request->sizes_id[$key];
                $attribute->quantity = $request->quantity[$key];
                $attribute->regular_price = $request->price[$key];
                $attribute->sale_price = $request->sale_price[$key];
                $attribute->save();

                }
                else{
                    if($request->quantity[$key]==""){}
                    else{
                        $attribute= new attribute;
                        $attribute->product_id= $request->product_id;
                        $attribute->color_id = $request->colors_id[$key];
                        $attribute->size_id = $request->sizes_id[$key];
                        $attribute->quantity = $request->quantity[$key];
                        $attribute->regular_price = $request->price[$key];
                        $attribute->sale_price = $request->sale_price[$key];
                        $attribute->save();
                    }
                }
        }

        
        if ($request->hasFile('product_image')) {
            // product image update start
            foreach ($request->file('product_image') as $key => $gallery_image) {
                if ($request->gallaryid[$key] != '') {
                    $gallery = gallery::findorfail($request->gallaryid[$key]);
                    $old_img = public_path('gallery/' . $gallery->image_name);
                    if (file_exists($old_img)) {
                        unlink($old_img);
                    }
                    $product_ext = Str::random(5) .$product_slug. '.' . $gallery_image->getClientOriginalName();
                    Image::make($gallery_image)->save(public_path('gallery/' . $product_ext), 80);
                    $gallery->image_name = $product_ext;
                    $gallery->product_id = $request->product_id;
                    $gallery->save();
                }
            }
        }


        if ($request->hasFile('add_new_product_image')) {
            // product image add new start
            $p_img = $request->file('add_new_product_image');
            foreach ($p_img as $value) {
                $product_ext = Str::random(7) . '-' . $product_slug . '.' . $value->getClientOriginalExtension();
                Image::make($value)->save(public_path('gallery/' . $product_ext), 80);
                $gallery = new gallery;
                $gallery->image_name = $product_ext;
                $gallery->product_id = $request->product_id;
                $gallery->save();
            }
        }
        return redirect()->route('viewProducts');
    }

    function deleteProduct($id){
        Product::findOrFail($id)->delete();
        return back();
    }
    function trashedProduct(){
        return view('backend.products.product_trashed',[
            'products'=> Product::onlyTrashed()->paginate(2),
        ]);
    }
    function restoreProduct($id){
         Product::onlyTrashed()->findOrFail($id)->restore();
         return back();
    }
    function permanentlyDeleteProduct($id){
        Product::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }
    function deleteallProducts(Request $request){
        foreach($request->delete as $delet){
            Product::findOrFail($delet)->delete();
             
         }
         return back();
    }


    function  delete_single_image($id){
        $galleries  = gallery::findorfail($id);
        $galleries_image_name= $galleries->image_name;
        $image_path= public_path('gallery/'.$galleries_image_name);
        // return response()->json($galleries);
            if(file_exists($galleries_image_name)){
                unlink($image_path);
            }
            $galleries->delete();
            return back();
    }
    function deleteattribute($attribute_id){
        $deleteattribute = attribute::findorfail($attribute_id)->delete();
        return back();
    }

}
