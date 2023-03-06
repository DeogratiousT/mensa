<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name','DESC')->simplePaginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()    
    {
        return view('categories.create');
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
            'name' => 'required|unique:categories,name',
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
            $path = $request->file('cover_image')->storeAs('categories/cover_images',$fileNameToStore,'covers');
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        //create category
        $category = new Category();
        $category->name = $request->name;
        $category->cover_image = $fileNameToStore;
        $category->save();
        
        return redirect()->route('categories.index')->with('success','Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $fileNameToStore = null;

        $this->validate($request, [
            'name' => 'required',
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
            $path = $request->file('cover_image')->storeAs('categories/cover_images',$fileNameToStore,'covers');  
        }

        
        //Update category
        $category->name = $request->name;

        if($request->hasFile('cover_image')){
            //delete first image
            if($category->cover_image != 'noimage.jpg'){
                Storage::disk('covers')->delete('categories/cover_images/'.$category->cover_image);
            }          
            $category->cover_image = $fileNameToStore;  
        }   
        $category->save();        
        
        return redirect()->route('categories.index')->with('success','Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->cover_image != 'noimage.jpg'){
            Storage::disk('covers')->delete('categories/cover_images/'.$category->cover_image);
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success','Category Deleted');
    }
}
