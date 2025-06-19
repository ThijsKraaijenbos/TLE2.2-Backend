<?php

namespace App\Http\Controllers;

use App\Http\Resources\StreakResource;
use App\Models\Streak;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class StreakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Get all users and their streaks and use this as a parameter in the Resource.
        // Otherwise it will not returned anything at all.
        $streaksUser = Streak::with('user')->get();
        // Return all users and their streaks and send it with a JSON format:
        $response = response()->json(
            [
                'message' => "Successfully retrieved all streaks and their users",
                'data' => StreakResource::collection($streaksUser)
            ], 200);
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store the request from the front-end check the inputs that
        // are required and send a JSON response with a 201 code

        $userToken = $request->header('X-user-login-token');
        if (!$userToken) {
            return response()->json(["error" => "Please provide an X-user-login-token header"], 404);
        }

        $token = PersonalAccessToken::findToken($userToken);
        if (!$token || $token->tokenable_type !== User::class) {
            return response()->json(["error" => "This user token is invalid"], 401);
        }

        // Normally you would use auth()->user() if you want to link to a pivot table
        // because you need to link the user as well

        $user = User::where('id', $token->tokenable_id)->first();


        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_date' => 'date',
            'last_completed_date' => 'date',
            'current_streak' => 'integer',
            'longest_streak' => 'integer'
        ]);


        $streak = new Streak($validated);

        // Old way of adding the columns one by one and inserting them into a table
        // $streak->start_date = $validated['start_date'];
        // $streak->last_completed_date = $validated['last_completed_date'];
        // $streak->current_streak = $validated['current_streak'];
        //$streak->longest_streak = $validated['longest_streak'];

        $streak->user_id = $user->id;
        $streak->save();


        return response()->json([
            'message' => "Succesfully added a new source",
            'data' => $streak
        ], 201);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $streakId = Streak::find($id);
        if (!$streakId) {
            return response()->json([
                'message' => "Streak not found",
            ], 404);
        }

        $streakResource = new StreakResource($streakId);
        $response = response()->json([
            'message' => "Successfully retrieved a single streak",
            'data' => $streakResource
        ], 200
        );
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // Store the request from the front-end check the inputs that
        // are required and send a JSON response with a 201 code

        $userToken = $request->header('X-user-login-token');
        if (!$userToken) {
            return response()->json(["error" => "Please provide an X-user-login-token header"], 404);
        }

        $token = PersonalAccessToken::findToken($userToken);
        if (!$token || $token->tokenable_type !== User::class) {
            return response()->json(["error" => "This user token is invalid"], 401);
        }

        // Normally you would use auth()->user() if you want to link to a pivot table
        // because you need to link the user as well

        $user = User::where('id', $token->tokenable_id)->first();

        // request all the inputs keys
        // validate all the input keys
        // add extra logic in case of authorization

        $streak = Streak::find($id);
        if(!$streak){
            return response()->json(['message' => 'Streak not found'], 404);
        }

        if ($streak->user_id !== $user->id) {
            return response()->json([
                'message' => 'You are not eligble to edit this streak, you dont have authorisation'
            ], 403);
        }


        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_date' => 'date',
            'last_completed_date' => 'date',
            'current_streak' => 'integer',
            'longest_streak' => 'integer'
        ]);

        $streak = new Streak($validated);
        $streak->user_id = $user->id;
        $streak->save();

        return response()->json([
            'message' => "Succesfully added a new source",
            'data' => $streak
        ], 201);


//        $request->validate($streak);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
