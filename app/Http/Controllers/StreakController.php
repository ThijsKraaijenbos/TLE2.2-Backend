<?php

namespace App\Http\Controllers;

use App\Http\Resources\StreakResource;
use App\Models\Streak;
use Illuminate\Http\Request;

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
                'message' => "All users and their streaks returned",
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
            'message' => "Succesfully retrieved a single streak",
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
