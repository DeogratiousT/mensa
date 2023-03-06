<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->limit(4)->get();
        return view('index', compact('products'));
    }

    public function shop()
    {
        $products = Product::orderBy('created_at','desc')->simplePaginate(12);
        return view('shop', compact('products'));
    }
}
