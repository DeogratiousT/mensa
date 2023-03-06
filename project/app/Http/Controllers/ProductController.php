<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->simplePaginate(12);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'rating' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'cover_image' => 'image|required|max:1999'
        ]);

        //Handle File upload
        if($request->hasFile('cover_image')){
            //Get File Name with the Extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just File name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('products/cover_images',$fileNameToStore,'covers');
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        //create product
        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->rating = $request->rating;
        $product->cover_image = $fileNameToStore;
        $product->save();
        
        return redirect()->route('products.index')->with('success','Product Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $fileNameToStore = null;

        $this->validate($request, [
            'name' => 'required|string',
            'rating' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_image')){           
            //Get File Name with the Extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just File name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;         
            //Upload Image
            $path = $request->file('cover_image')->storeAs('products/cover_images',$fileNameToStore,'covers');  
        }

        
        //Update product        
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->rating = $request->rating;
        $product->save();

        if($request->hasFile('cover_image')){
            //delete first image
            if($product->cover_image != 'noimage.jpg'){
                Storage::disk('covers')->delete('products/cover_images/'.$product->cover_image);
            }          
            $product->cover_image = $fileNameToStore;  
        }   
        $product->save();
        
        
        return redirect()->route('products.index')->with('success','Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->cover_image != 'noimage.jpg'){
            Storage::disk('covers')->delete('products/cover_images/'.$product->cover_image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success','Product Deleted');
    }
}
