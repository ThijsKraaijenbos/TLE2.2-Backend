<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required",
            "role" => Rule::in(UserRole::cases()),
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

        return response()->json(["User created"], 201);

    }
}
