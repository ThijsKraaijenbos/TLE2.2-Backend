<?php

namespace App\Http\Controllers;

use App\Models\FunFact;
use Illuminate\Http\Request;

class FunFactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $funFacts = FunFact::with('fruit')->get();
            return response()->json(
                [
                    'message' => "Successfully retrieved all fun facts",
                    'data' => $funFacts,
                ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 404);
        }
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
    public function show(FunFact $funFact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FunFact $funFact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FunFact $funFact)
    {
        //
    }
}
