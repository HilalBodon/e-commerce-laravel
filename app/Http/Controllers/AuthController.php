<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api',['except' => ['login','register']]);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'full_name' => 'string',
            'phone' => 'string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json(['message' => 'User successfully created','user'=>$user],201);
    }


    public function login(Request $request){ 
            $validator = Validator::make($request->all(),[
                'email' => 'email',
                'password' => 'string|min:6',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }
            if(!$token=auth()->attempt($validator->validated())){
                return response()->json(['error'=>'Unauthorized'],401);
            }
            return $this->createNewToken($token);
        }
            
         function createNewToken($token){
             return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in'=>auth()->factory()->getTTL()*60,
                'user'=>auth()->user()
             ]);
            }
 

    public function profile(){
        return response()->json(auth()->user()); 
    }

    public function logout(){
    auth()->logout();
    return response()->json([
        'message' => 'user logged out registered']);
    }


    public function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
   if(Auth:: attempt($credentials)){
return redirect()->intended(route('home'));
   }
   return redirect(route(name:'login'))->with('error','Login details are not valid');
    }



}