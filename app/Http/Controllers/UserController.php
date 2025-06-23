<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Resources\UserResource;
use App\Models\ProfileImage;
use App\Models\Streak;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\PersonalAccessToken;
use function Symfony\Component\String\b;

class UserController extends Controller
{
    //random comment because deployment went wrong :(
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
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->profile_image_id = 1;
            $user->save();

            // Create a streak after the user is made
            $user->streak()->create([
                'start_date' => date('d-m-Y'),
                'last_completed_date' => date('d-m-Y'),
                'current_streak' => 0,
                'longest_streak' => 0,
            ]);

            //workaround because directly doing $user->with("streak"); in the response didnt work
            $user->load("streak");
            return response()->json([
                "message" => "Successfully created new user",
                "user" => new UserResource($user)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "An exception occurred",
                "error" => $e->getMessage()
            ], 500);
        }

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
        $userTokenId = $token->tokenable_id;



        $user = match ($withVariable) {
            'streak, profileImage' => User::with('profileImage', 'streak')->where('id', $userTokenId)->first(),
            'streak' => User::with('streak')->where('id', $userTokenId)->first(),
            'profileImage' => User::with('profileImage')->where('id', $userTokenId)->first(),
            default => User::where('id', $userTokenId)->first(),
        };


        return response()->json(
            [
                "message" => "Successfully retrieved user",
                "userData" => new UserResource($user),
            ], 200);
    }

    public function update(Request $request, User $user)
    {

        if ($user->id !== $request->token->tokenable_id) {
            return response()->json(['error' => "Not authorized to edit this user's profile"], 403);
        }

        if ($request->profile_image_id) {

            if (!is_int($request->profile_image_id)) {
                return response()->json(['error' => 'Profile image id must be an integer'], 400);
            }

            try {

            if (!ProfileImage::find($request->profile_image_id)) {
                return response()->json(['error' => 'Profile image id does not exist'], 404);
            }

            $user->profile_image_id = $request->profile_image_id;

            } catch (\Exception $error) {
                return response()->json(['error' => 'Please try again later'], 500);

            }

        }

        if ($request->name) {

            if (!is_string($request->name)) {
                return response()->json(['error' => 'Name must be a string'], 400);
            }

            if ($request->name === '') {
                return response()->json(['error' => 'Name can not be empty'], 400);
            }

            if (strlen($request->name) > 255) {
                return response()->json(['error' => 'Name can not be longer than 255 characters'], 400);
            }

            $user->name = $request->name;
        }

        try {

            $user->save();

            $formattedUser = [
                'name' => $user->name,
                'profile_image' => $user->profileImage
            ];

            return response()->json(['message' => 'Profile successfully updated', 'user' => $formattedUser], 200);

        } catch (\Exception $error) {

            return response()->json(['error' => 'Please try again later'], 500);

        }

    }

}
