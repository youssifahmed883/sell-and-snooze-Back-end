<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{
    // function register
    public function register(Request $request) {
        $validator= Validator::make($request->all(),[
            'name'=>'required|max:191|unique:users',
            'email'=>'required|email|max:191|unique:users,email',
            'phone'=>'required',
            'roleAs'=>'required',
            'password'=>'required|min:8',
        ]);
        $name = User::where('name', $request->name)->first();
        $user = User::where('email', $request->email)->first();
        $phone = User::where('phone', $request->phone)->first();
        if($user){
            return response()->json([
                'status'=>501,
                'message'=>'Email is already taken ',
                // 'userEmail'=>$user->email,
            ]);
        }else if($phone){
            return response()->json([
                'status'=>502,
                'message'=>'Phone is already taken ',
                // 'userEmail'=>$user->email,
            ]);
        }else if($name){
            return response()->json([
                'status'=>503,
                'message'=>'User Name is already taken ',
                // 'userEmail'=>$user->email,
            ]);
        }
        else {
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'roleAs'=>$request->roleAs,
                'password'=>Hash::make($request->password),


            ]);
            $token = $user->createToken($user->email.'_Token')->plainTextToken;

            return response()->json([
                'status'=>200,
                'username'=>$user->name,
                'token'=>$token,
                'message'=>$user->name ." ". 'is Registered successfully',
                'userEmail'=>$user->email,
                'roleAs'=>$user->roleAs,
                'photo'=>$user->photo,
                'id'=>$user->id,
                'Address'=>$user->Address,
                'City'=>$user->City,

            ]);
        }

    }
    // function login
    public function login(Request $request) {
        $validator= Validator::make($request->all(),[
            'email'=>'required|email|max:191',
            'password'=>'required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'validation_errors'=>$validator->messages(),
            ]);
        }
        else {
            $user = User::where('email', $request->email)->first();

            if (! $user ) {
                return response()->json([
                    'status'=>500,
                    'message'=>'Invalid Email',
                    // 'userEmail'=>$user->email,
                ]);

            }
            else if ( ! Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status'=>401,
                    'message'=>'Invalid Password',
                    'userEmail'=>$user->email,
                ]);
            }
            else {
                $token = $user->createToken($user->email.'_Token')->plainTextToken;

                return response()->json([
                    'status'=>200,
                    'username'=>$user->name,
                    'token'=>$token,
                    'message'=>$user->name ." ". 'is Registered successfully',
                    'userEmail'=>$user->email,
                    'roleAs'=>$user->roleAs,
                    'auth_Photo'=>$user->photo,
                    'id'=>$user->id,
                    'dark_mode'=>$user->dark_mode,
                    'Address'=>$user->Address,
                    'City'=>$user->City,
                    'completeRigester'=>$user->completeRigester,
                ]);
            }
        }
    }
    // function logout
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Logged out successfully',
        ]);
    }
}
