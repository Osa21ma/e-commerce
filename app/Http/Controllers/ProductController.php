<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.products.index')->with('products',$products);

    }
    public function create(){

        return view('admin.products.create');
    }
    public function store(Request $request){

        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required|string|',
            'price'=>'required|integer|min:0',
            'quantity'=>'required|integer|min:1',
            'image'=>'nullable|image|mimes:png,jpg|max:2048',
        ]);
        
        if ($request->hasFile('image')) {
            $data['image']= Storage::putFile('products',$request->image);

        }

        Product::create($data);
        session()->flash('success','Product Created Successfully');
        return redirect('products');  
    }

    public function edit($id){
        $product = Product::findOrFail($id);

        return view('admin.products.edit',compact('product'));

    }
    public function update(Request $request,$id){
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required|string|',
            'price'=>'required|integer|min:0',
            'quantity'=>'required|integer|min:1',
            'image'=>'nullable|image|mimes:png,jpg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            Storage::delete($product->image);
            $data['image']= Storage::putFile('products',$request->image);
            $product->update($data);
            session()->flash('success','Product Updated Successfully');
            return redirect('products'); 

        }
    } 
    public function delete($id){
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::delete($product->image);

        }
        $product->delete();
        session()->flash('success','Product deleted Successfully');
        return redirect('products'); 

    }   
}
