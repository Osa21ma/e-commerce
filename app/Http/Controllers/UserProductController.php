<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('user.products.index',compact('products'));

    }
    public function displayCart(){
        $cart = session()->get('cart');

        return view('user.products.cart',compact('cart'));

    }
    public function show($id){
        $product = Product::find($id);
        return view('user.products.show',compact('product'));

    }
    public function addCart(Request $request,$id){
        $product = Product::find($id);
        if(!$product){
            return redirect()->back();
        }
        $cart = session()->get('cart',[]);

        if(isset($cart[$id])){
            $cart[$id]['quantity'] += $request->qty;
        }else{
            $cart[$id]=[
                'name'=>$product->name,
                'description'=>$product->description,
                'price'=>$product->price,
                'image'=>$product->image,
                'quantity'=>$request->qty,
            ];
        }

        session()->put('cart',$cart);
        session()->flash('success','Product Added Successfully');
        return redirect()->back();

    }

    public function removeCart($id){
        $cart = session()->get('cart');

        if(isset($cart[$id])){
            unset($cart[$id]);
        }
        session()->put('cart',$cart);
        return redirect()->back();

    }
}
