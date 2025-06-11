<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileImageRequest;
use App\Http\Requests\UpdateProfileImageRequest;
use App\Models\ProfileImage;

class ProfileImageController extends Controller
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
    public function store(StoreProfileImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileImage $profileImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfileImage $profileImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileImageRequest $request, ProfileImage $profileImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileImage $profileImage)
    {
        //
    }
}
