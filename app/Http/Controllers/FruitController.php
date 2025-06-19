<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFruitRequest;
use App\Http\Requests\UpdateFruitRequest;
use App\Http\Resources\FruitResource;
use App\Http\Resources\FruitUserResource;
use App\Models\Fruit;
use App\Models\FruitUser;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use mysql_xdevapi\Exception;
use function Laravel\Prompts\error;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FruitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Exception $exception)
    {
        try {
            $fruitPivotsData = Fruit::with(['users', 'facts'])->get();
            $response = response()->json([
                'message' => 'Successfully retrieved all fruits',
                'data' => FruitResource::collection($fruitPivotsData)
            ], 200);
            return $response;
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // When you are storing data it really doesnt matter what columns you request
        // You just have to request the columns u want to request thats it and validate them
        try {
            $validated = $request->validate([
                'fruit_id' => 'required|integer',
                'has_eaten_before' => 'required|boolean',
                'like' => 'required|boolean'
            ]);

            // Request all the data
            $requestFormData = $request->all();


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

            // attach the user to the fruit_user pivot table with the requested keys
            $user->fruits()->attach(
                $validated['fruit_id'], [
                'has_eaten_before' => $validated['has_eaten_before'],
                'like' => $validated['like'],
            ]);

            return response()->json([
                'message' => "Succesfully added a new source",
                'data' => [$user, $validated]
            ], 201);


        } catch (\Exception $error) {
            return response()->json(
                [
                    'error' => $error->getMessage()
                ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $fruit)
    {
        try {
            // Declare the variables
            $response;
            $fruitId = Fruit::with('facts')->find($fruit);
            // Check if the resource is empty or null
            if (!$fruitId) {
                $response = response()->json(['message' => 'Fruit not found'], 404);
                return $response;
            }


            $fruitResource = new FruitResource($fruitId);
            $response = response()->json([
                'message' => "Successfully retrieved a single fruit",
                'data' => $fruitResource
            ], 200);


            return $response;

        } catch (\Exception $exception) {
            $respone = response()->json(['error' => $exception->getMessage()], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fruit $fruit)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fruit $fruit)
    {
        try {
            // validations, request input fields, sync or attach to pivottable if needed, send json resposne with 201 code
            // validate all fields
            // when the user changes if he likes the fruit or not
            $validated = $request->validate([
                'fruit_id' => 'required|integer',
                'has_eaten_before' => 'boolean',
                'like' => 'boolean'
            ]);

            $userToken = $request->header('X-user-login-token');
            if (!$userToken) {
                return response()->json(["error" => "Please provide an X-user-login-token header"], 404);
            }

            $token = PersonalAccessToken::findToken($userToken);
            if (!$token || $token->tokenable_type !== User::class) {
                return response()->json(["error" => "This user token is invalid"], 401);
            }

            $user = User::where('id', $token->tokenable_id)->first();


            // Before updating the id must be the same as the fruit_id you are trying to change
            if ($fruit->id !== $request->input(['fruit_id'])) {
                return response()->json(
                    [
                        'message' => 'Wrong fruit id, change it to correct id'
                    ]
                );
            }
            // Not sure if i should check if the user that is logged in is the same user changing it

            // updateExistingPivot takes, as its first argument, the id of the row on the related table, not the id of the row on the pivot table.
            $user->fruits()->updateExistingPivot(
                $validated['fruit_id'], // Always start with the id
                [
                    'has_eaten_before' => $validated['has_eaten_before'],
                    'like' => $validated['like']
                ]);
            return response()->json(
                [
                    'message' => 'Fruit resource successfully updated',
                    'changed_by_user' => $user,
                    'pivot_table_updated_data ' => [
                        'has_eaten_before' => $validated['has_eaten_before'],
                        'like' => $validated['like']
                    ]
                ]
                , 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fruit $fruit)
    {
        //
    }
}
