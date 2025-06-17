<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AutController extends Controller
{
    public function register(Request $request){
        $validate = Validator::make($request->all(),[
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|confirmed',
        ]);

        if($validate->fails()){
            return response()->json([
                'status'=>'failled',
                'error'=>$validate->errors()
            ],300);
        }

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
        ]);

        return response()->json([
            'success'=>'success',
            'data'=>$user
        ],300);
    }
    public function login(Request $request){
        $validate = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|string',
        ]);

        if($validate->fails()){
            return response()->json([
                'status'=>'failled',
                'error'=>$validate->errors()
            ],300);
        }
        $user = User::where('email',$request->email)->first();
        if ($user) {
            $password_verfiy = Hash::check($request->password,$user->password);
            if($password_verfiy){

                $access_token = bin2hex(random_bytes(32));
                $user->access_token =$access_token;
                $user->save();
                return response()->json([
                    'status'=>'success',
                    'msg'=>'your are logged in',
                    'access_token'=>$access_token
                ],200);
            }else{
                return response()->json([
                    'status'=>'failled',
                    'msg'=>'your password is wrong'
                ],300);
            }

        }
        return response()->json([
            'status'=>'failled',
            'msg'=>'your email is wrong'
        ],300);
    }
}
