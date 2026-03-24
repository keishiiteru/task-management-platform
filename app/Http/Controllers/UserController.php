<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Config\Exception\ValidationException;

class UserController extends Controller
{
    public function login(LoginUserRequest $request){
        $request->validated($request->all());

        if(Auth::attempt($request->only('email','password'))){
            //return $this->error('','Credentials do not match', 401);
            $user = User::where('email', $request->email)->first();

            $token =  $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid credentials'
        ]);
    }
}
