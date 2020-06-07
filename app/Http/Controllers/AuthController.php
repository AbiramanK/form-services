<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validater = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        if (!$validater->fails()) {
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->save();
            return response()->json([
                'message' => 'Successfully created user!',
                'status'  => 'success'
            ], 201);
        }

        return response()->json([
            'message' => implode(" ", $validater->errors()->all()),
            'status'  => 'fails'
        ], 422);
    }

    public function signin(Request $request)
    {
        $validater = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        if (!$validater->fails()) {
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status' => "fails",
                    'message' => 'Unauthorized',
                ], 401);
            }
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
                'status'  => 'success',
                'message' => "Logged in successfully!"
            ]);
        }

        return response()->json([
            'message' => implode(" ", $validater->errors()->all()),
            'status'  => 'fails'
        ], 422);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',
            'status'  => 'success'
        ], 200);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function checkUsername(Request $request)
    {
    }

    // public function login(Request $request) {
    //     $validation = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required|min:8'
    //     ]);

    //     if(!$validation->fails()) {
    //         $credentials = [
    //             'email' => $request->email,
    //             'password' => $request->password
    //         ] ;

    //         if(Auth::attempt($credentials)) { 
    //             $user = Auth::user(); 
    //             $token = $user->createToken("APP_TOKEN")->accessToken ;
    //             return ResponseController::Response(Config("response_message.MESSAGES.LOGIN_SUCCESS"), [
    //                 "access_token" => $token,
    //                 "user" => Auth::user()
    //                 // 'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
    //             ]) ;
    //         } else {
    //             return ErrorController::Error(404, ["Email / Password wrong"]) ;
    //         }
    //     } else {
    //         return ErrorController::Error(422, $validation->errors()->all()) ;
    //     }

    // }
}
