<?php

namespace App\Http\Controllers;
use App\Models\color;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;

class ColorController extends Controller
{
    function color(){
        $color = color::OrderBy('color_name','asc')->paginate(5);
        return view('backend.color.color_view',compact('color'));
    }
    function addcolor(){
        return view('backend.color.color_form');
    }
    function postcolor(Request $request){
        $request->validate([
            'color_name'=>['required','unique:colors'],
            'slug' =>['required','unique:colors'],
        ]);
        $cat = new color;
        $cat->color_name = $request->color_name;
        $cat->slug = $request->slug;
        $cat->save();
        return back();
    }
}
