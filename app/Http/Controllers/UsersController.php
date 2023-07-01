<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public UsersService $usersService;


    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = $this->usersService->getAllUsers($request);

        return $users;
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
        
        $user = User::with('galleries')->find($id);
        return response()->json([
            'user' => $user,
        ]);
    }

    public function getUserGalleries($userId)
    {
        $user = User::with('galleries')->find($userId);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404);
        }

        $galleries = $user->galleries;

        return response()->json([
            'status' => 'success',
            'galleries' => $galleries,
        ]);
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
