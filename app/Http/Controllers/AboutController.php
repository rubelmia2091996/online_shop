<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    function about(){
        $tottal= 100;
        $earningMarks= 80;
        $pass= "tottal mark is ".$tottal."And my mark is".$earningMarks;
        return view('about',['pas'=>$pass,]);
    }
}
