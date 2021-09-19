<?php

namespace App\Http\Controllers;
use App\Models\size;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
class SizeController extends Controller
{
    function size(){
        $size = size::OrderBy('size_name','asc')->paginate(5);
        return view('backend.size.size_view',compact('size'));
    }
    function addsize(){
        return view('backend.size.size_form');
    }
    function postsize(Request $request){
        $request->validate([
            'size_name'=>['required','unique:sizes'],
            'slug' =>['required','unique:sizes'],
        ]);
        $cat = new size;
        $cat->size_name = $request->size_name;
        $cat->slug =$request->slug;
        $cat->save();
        return back();
    }
}
