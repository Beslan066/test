<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;





class HomeController extends Controller
{
    public function index() {
    
        $products = Product::where('id', 5)->first();


        return view('index');
    }


    public function products() {
    
        $products = Product::get();


        return $products;
    }
    
}
