<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class FriendUserController extends Controller
{

    //Ability to add friends via email
    public function addFriend(Request $request)
    {
        $request->validate([
            'email' => "required|exists:users",
        ], [
            'email.exists' => "No user with this email exists"
        ]);

        $token = $request->token; //This token comes from the ValidateUserLoginToken middleware
        $sendingUser = User::where('id', $token->tokenable_id)->first(); //Get the user who sent the friend request
        $receivingUser = User::where('email', $request->email)->first(); //User who recieved the friend request

        //Check if the user is already friends with the other user
        $alreadyFriends = $sendingUser->friends()->get()->contains($receivingUser->id);
        if ($alreadyFriends) {
            return response()->json([
                "message" => "These users are already friends",
            ]);
        }

        //  try catch block just in case something goes wrong with the database or something
        // might be unnecessary but better to have extra safety to make sure it goes well
        try {
            $sendingUser->friends()->attach($receivingUser);
            $receivingUser->friends()->attach($sendingUser);
            return response()->json([
                "message" => "Successfully added user as friend",
                "sender" => new UserResource($sendingUser),
                "receiver" => new UserResource($receivingUser)
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e,
            ]);
        }
    }

    public function showFriends(Request $request)
    {
        //Ability to see all friends w their streaks
        $token = $request->token; //This token comes from the ValidateUserLoginToken middleware
        $user = User::where('id', $token->tokenable_id)->first();

        $friends = $user->friends()->with("streak")->get();

        return response()->json([
            "friends" => UserResource::collection($friends)
        ]);
    }
}
