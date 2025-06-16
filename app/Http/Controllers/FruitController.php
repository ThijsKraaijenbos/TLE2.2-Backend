<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFruitRequest;
use App\Http\Requests\UpdateFruitRequest;
use App\Http\Resources\FruitResource;
use App\Models\Fruit;
use function Laravel\Prompts\error;
use function PHPUnit\Framework\isEmpty;

class FruitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $response = response()->json([
            'message' => 'All fruits returned',
            'data' => FruitResource::collection(Fruit::all())
        ], 200);
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFruitRequest $request)
    {
        // validations, request input fields, sync or attach to pivottable if needed, send json resposne with 201 code
    }

    /**
     * Display the specified resource.
     */
    public function show(string $fruit)
    {
        // Declare the variables
        $response;
        $fruitId = Fruit::find($fruit);

        // Check if the resource is empty
        if (!$fruitId) {
            $response = response()->json(['message' => 'Fruit not found'], 404);
            return $response;
        }


        $fruitResource = new FruitResource($fruitId);
        $response = response()->json([
            'message' => "Succesfully retrieved a single assignment",
            'data' => $fruitResource
        ], 200);


        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fruit $fruit)
    {
        // validations, request input fields, sync or attach to pivottable if needed, send json resposne with 201 code
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFruitRequest $request, Fruit $fruit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fruit $fruit)
    {
        //
    }
}
