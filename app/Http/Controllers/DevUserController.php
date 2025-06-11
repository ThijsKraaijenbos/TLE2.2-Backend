<?php

namespace App\Http\Controllers;

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
            'email.required' => 'Vul een email in',
            'email.unique' => 'Dit email is al in gebruik',
            'password.required' => 'Vul een wachtwoord in',
        ]);

        $user = new DevUser();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('API_KEY')->plainTextToken;

        return redirect()->route("dev.index")->with('API_KEY', $token);
    }

    public function testLogin(Request $request) {
        return response()->json($request->user());
    }

}
