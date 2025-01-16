<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\amenities;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UsersController extends Controller
{
    public function user_login(Request $request)
    {
        // $creds = $request->only(['email', 'password']);  
        // if (!$token = auth()->attempt($creds)) {
        //     return response()->json([
        //         'success' => false
        //     ]);
        // }
        // return response()->json([
        //     'success' => true,
        //     'token' => $token,
        //     'user' => Auth::User(),
        // ]);  

        $creds = $request->only('email','password');
        //check email
        $user = User::where('email', $request->email)->first();
        if(!$token = auth()->attempt($creds)){
           return response()->json([
               'success'=>false
             ],401);
         }
         else{
           $token  = $user->createToken('myapptoken')->plainTextToken; 
        //    $apiAuth = $user->ApiAuth;
         }
   
        return response()->json([
           'success' =>true,
           'token' =>$token,
           'details' => $user
        ]);



    }

    public function user_register(Request $request)
    {
        $encryptpass = Hash::make($request->password);
        $user = new User;

        try {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $encryptpass;

            $user->save();
            return $this->user_login($request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }



    public function user_details(Request $request)
    {
        $userid = $request->user_id;
        return UserResource::collection(User::Where('id', $userid)->get());
    }
}
