<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssignmentResource;
use App\Http\Resources\UserResource;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $response = response()->json(
            [
                'message' => "Succesfully retrieved all assignments",
                'data' => AssignmentResource::collection(Assignment::all())
            ], 200);
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assignmentId = Assignment::find($id);
        if (!$assignmentId) {
            $response = response()->json([
                'message' => "Assignment not found",
            ], 404);
            return $response;
        } else {
            $assignmentResource = new AssignmentResource($assignmentId);
            $response = response()->json([
                'message' => "Succesfully retrieved a single assignment",
                'data' => $assignmentResource
            ], 200);

            return $response;
        }


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
