<?php

namespace App\Http\Controllers\Auth\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*==========================================================
       Type: post
       return: login token
       Note:
       Signature: tamzidpeace, 17-06-2021
    ==========================================================*/
    public function login(Request $request)
    {
        try {
            $login = $request->validate([
                'email' => 'required|string',
                'password' => 'required',
            ]);

            if (!Auth::attempt($login)) {
                $response = ['success' => 'false', 'code' => 400, 'message' => 'invalid login credential!'];
                return \response()->json($response);
            } else {
                $token = Auth::user()->createToken('authToken')->accessToken;
                $response = ['success' => 'true', 'code' => 200, 'message' => 'user successfully logged in', 'token' => $token, 'data' => Auth::user()];
                return \response()->json($response);
            }
        } catch (\Exception $e) {
            $response = ['success' => 'false', 'code' => 400, 'message' => 'an error occurred!', 'error' => $e];
            return response()->json($response);
        }
    }



    /*==========================================================
           Type: post
           return: user registration
           Note:
           Signature: tamzidpeace, 17-06-2021
     ==========================================================*/
     public function register(Request $request)
     {
         try {
             $request->validate([
                 'name' => 'required|string',
                 'email' => 'required|string|email|unique:users,email',
                 'password' => 'required|min:4|max:4|string',
             ]);
 
             $user = new User([
                 'name' => $request->name,
                 'email' => $request->email,
                 'password' => bcrypt($request->password),
             ]);
 
             $user->save();
             $response = ['success' => 'true', 'code' => 201, 'message' => 'Registration Completed!', 'data' => $user];
             return \response()->json($response);
         } catch (\Exception $e) {
             $response = ['success' => 'false', 'code' => 400, 'message' => 'an error occurred!', 'error' => $e];
             return response()->json($response);
         }
     }








    /*==========================================================
           Type: post
           return: logout & token session expired
           Note:
           Signature: tamzidpeace, 17-06-2021
        ==========================================================*/
    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            $response = ['success' => 'true', 'code' => 200, 'message' => 'user successfully logged out', 'data' => ''];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ['success' => 'false', 'code' => 400, 'message' => $e];
            return response()->json($response);
        }
    }

}