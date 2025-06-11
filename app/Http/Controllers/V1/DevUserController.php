<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\DevUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DevUserController extends Controller
{
    //Index function for the dev panel to show the view to generate api key
    public function index() {
        return view('devpanel/register');
    }

    //Register api user function (generating a key)
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:dev_users',
            'password' => 'required',
        ],
        [
            'email.required' => 'Email is required',
            'email.unique' => 'Email has already been taken',
            'password.required' => 'Password is required',
        ]);

        $user = new DevUser();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('API_KEY')->plainTextToken;

        $res = [
            'message' => "User Created",
            'user' => $user,
            'token' => $token
        ];
        return view('devpanel/register', compact('res'));
    }

}
