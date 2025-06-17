<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $response = ProductResource::collection($products);
        return response()->json([
            'status'=>'success',
            'data'=>$response
        ],200);

    }
    public function show($id){
        $product = Product::find($id);
        if(!$product){
            return response()->json([
                'msg'=>'empty Data'
            ],404);
        }
        return new ProductResource($product);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'description'=>'required|string|',
            'price'=>'required|integer|min:0',
            'quantity'=>'required|integer|min:1',
            'image'=>'nullable|image|mimes:png,jpg|max:2048',
        ]);
        if($validate->fails()){
            return response()->json([
                'error'=>$validate->errors()
            ],300);
        }
        $image = Storage::putFile('products',$request->image);
        Product::create([
            'id'=>$request->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'image'=>$image,
        ]);
        return response()->json([
            'msg'=>'product Created SUCCESSFULLY',
            'status'=>'success'
        ],200);
    }

    public function update(Request $request,$id){
        $product = Product::find($id);
        
        if(!$product){
            return response()->json([
                'msg'=>'empty Data'
            ],404);
        }    

        $validate = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'description'=>'required|string|',
            'price'=>'required|integer|min:0',
            'quantity'=>'required|integer|min:1',
            'image'=>'nullable|image|mimes:png,jpg|max:2048',
        ]);
        if($validate->fails()){
            return response()->json([
                'status'=>'failled',
                'error'=>$validate->errors()
            ],300);
        }

        $image= $product->image;
        if ($request->hasFile('image')) {
            Storage::delete($product->image);
            $image = Storage::putFile('products',$request->image);
        }
        $product->update([
            'id'=>$request->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'image'=>$image,
        ]);
        return response()->json([
            'msg'=>'product Updated SUCCESSFULLY',
            'status'=>'success'
        ],200);
    }

    public function delete($id){
        $product = Product::find($id);
        
        if(!$product){
            return response()->json([
                'msg'=>'empty Data'
            ],404);
        } 
        if ($product->image) {
            Storage::delete($product->image);
        
        }
        $product->delete();
        return response()->json([
            'msg'=>'product Deleted SUCCESSFULLY',
            'status'=>'success'
        ],200);
    }

}
