<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    function viewcart(){
        return view('frontend.pages.cart');

    }
}
