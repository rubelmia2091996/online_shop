<?php

namespace App\Http\Controllers;

use App\Models\catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Unique;

use function GuzzleHttp\Promise\all;

class CatagoryController extends Controller
{
    function catagory(){
        $cats = Catagory::OrderBy('catagory_name','asc')->paginate(5);
        // $cats = Catagory::OrderBy('catagory_name','asc')->get();
        return view('backend.catagory.catagory_view',compact('cats'));
    }
    function addcatagory(){
        return view('backend.catagory.catagory_form');
    }
    function postcatagory(Request $request){
        // return "OK";
        $request->validate([
            'catagory_name'=>['required','unique:catagories'],
            'slug' =>['required','unique:catagories'],
        ]);
        $cat = new Catagory;
        $cat->catagory_name = $request->catagory_name;
        $cat->slug = str::slug($request->catagory_name);
        // return $request->all();
        $cat->save();
        return back();
    }
    function deletecatagory($id){
        // catagory::findorFail($id)->delete();
        // return catagory::where('id', $id)->get();
        // return catagory::whereorfail('id', $id)->first()->delete();
        $cat= catagory::findorFail($id);
        if($cat->subCategory->count()<0){
            catagory::findorFail($id)->delete();
            return back();

        }
        else{
            
            return back();
        }
    }
    function updatecatagory($id){
        $cat= catagory::findorFail($id);
        return view('backend.catagory.catagory_update', compact('cat'));
    }
    function updatedcatagory(Request $request){
    //    $cat= catagory::findorFail($request->cat_id);
    //    $cat->catagory_name = $request->catagory_name;
    //     $cat->slug = str::slug($request->catagory_name);
    //     $cat->save();
    $cat= catagory::findorFail($request->cat_id)->update(['catagory_name' => $request->catagory_name,
    'slug' => str::slug($request->catagory_name),]);
        return back();
    }
    function trashedcatagory(){
        // $cats = Catagory::OrderBy('catagory_name','asc')->paginate(5);
        return view('backend.catagory.trashed',[
            'catagories' =>catagory::onlyTrashed()->paginate(5)
        ]);
    }
    function restorecatagory($id){
        catagory::onlyTrashed()->findOrFail($id)->restore();
        return back();

    }
    function permanentdeletecatagory($id){
        catagory::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }
}
