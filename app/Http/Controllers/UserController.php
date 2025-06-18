<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\PersonalAccessToken;
use function Symfony\Component\String\b;

class UserController extends Controller
{
    public function register(Request $request): JsonResponse
    {
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

        return response()->json(["message" => "Successfully created new user"], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(["error" => "Account with this e-mail does not exist"], 404);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(["error" => "Invalid password"], 404);
        }

        //first delete any old login tokens to not cause issues
        $user->tokens()->delete();

        $token = $user->createToken('user_login_token', ['user_login_token'])->plainTextToken;

        return response()->json(["user-login-token" => $token]);
    }

    public function user(Request $request): JsonResponse
    {
        $token = $request->token; //This token comes from the ValidateUserLoginToken middleware

        $withVariable = $request->header('X-with');

        $user = match ($withVariable) {
            'streak, profileImage' => User::with('profileImage', 'streak')->where('id', $token->tokenable_id)->first(),
            'streak' => User::with('streak')->where('id', $token->tokenable_id)->first(),
            'profileImage' => User::with('profileImage')->where('id', $token->tokenable_id)->first(),
            default => User::where('id', $token->tokenable_id)->first(),
        };


        return response()->json(
            [
                "message" => "Successfully retrieved user",
                "userData" => new UserResource($user),
            ], 200);
    }


}
