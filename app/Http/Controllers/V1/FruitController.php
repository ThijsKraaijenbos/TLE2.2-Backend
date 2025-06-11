<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFruitRequest;
use App\Http\Requests\UpdateFruitRequest;
use App\Models\Fruit;

class FruitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Fruit $fruit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fruit $fruit)
    {
        //
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
