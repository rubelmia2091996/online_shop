<?php

namespace App\Http\Controllers;

use App\Models\catagory;
use App\Models\SubCategory;
// use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    function subcategory(){
        return view('backend.sub_category.sub_catagory_view',[
            "subcat"=> SubCategory::with('catagory')->paginate(5)
        ]);
    }
    function addsubcatagory(){
        return view('backend.sub_category.sub_catagory_form',[
            'category'=> catagory::OrderBy('catagory_name','asc')->get()
        ]);
    }
    function postsubcategory(Request $request){
        $cat = new SubCategory;
        $cat->subcategory_name = $request->subcatagory_name;
        $cat->slug = $request->slug;
        $cat->catagories_id = $request->catagory;
        $cat->save();
        return back();
    }
    function deletesubategory($id){
        SubCategory::findorFail($id)->delete();
        return back();
    }
    function updatesubcategory($id){
        // $subcat= SubCategory::findorFail($id);
        return view('backend.sub_category.sub_catagory_update',[
            'subcat'=> SubCategory::findorFail($id),
            'category'=> catagory::OrderBy('catagory_name','asc')->get(),
        ]);
    }
    function updatedsubcategory(Request $request){
    $subcat= SubCategory::findorFail($request->cat_id)->update(['subcategory_name' => $request->subcategory_name,
    'slug' => $request->slug,'catagories_id'=>$request->catagory],);
        return back();
    }
    function trashedsubcategory(){
        return view('backend.sub_category.subcatagory_trashed',[
            'catagories' =>SubCategory::onlyTrashed()->paginate(5),
        ]);
    }
    function restoresubcategory($id){
        SubCategory::onlyTrashed()->findOrFail($id)->restore();
        return back();

    }
    function permanentdeletecatagory($id){
        SubCategory::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }

    function deleteallsubcategory(Request $request){
        foreach($request->delete as $delete){
           SubCategory::findOrFail($delete)->delete();
            
        }
        return back();
    }
    function restoreallsubcategory(Request $request){
        
        foreach($request->rest as $rest){
           SubCategory::onlyTrashed()->findOrFail($rest)->restore(); 
         }
        return back();
    }
    function permanentlyDeleteAllSubcategory(Request $request){
        
        foreach($request->rest as $rest){
            SubCategory::onlyTrashed()->findOrFail($rest)->forceDelete(); 
         }
         return back();
    }
}
