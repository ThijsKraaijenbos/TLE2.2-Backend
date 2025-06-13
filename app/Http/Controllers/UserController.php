<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required",
            "role" => ["required", Rule::in(UserRole::cases())],
        ], [
            'role.in' => "Please enter a valid role, you can choose from: " . UserRole::getRolesList(),
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->profile_image_id = 1;
        $user->save();

        return response()->json("User created", 201);
    }

    public function login(Request $request) {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(["Account with this e-mail does not exist"], 404);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(["Invalid password"], 404);
        }

        //first delete any old login tokens to not cause issues
        $user->tokens()->delete();

        $token = $user->createToken('user_login_token', ['user_login_token'])->plainTextToken;

        return response()->json($token);
    }

    public function checkUser(Request $request) {
        //I want to turn most of this into a middleware asap, just put it in here for the time being
        //to test if it'd work or not. (it does) :D
        $userToken = $request->header('X-user-login-token');
        $token = PersonalAccessToken::findToken($userToken);
        if (!$token || $token->tokenable_type !== User::class) {
            return response()->json(["This user token is invalid"], 401);
        }
        $user = User::where('id', $token->tokenable_id)->first();
        return response()->json($user);
    }
}
