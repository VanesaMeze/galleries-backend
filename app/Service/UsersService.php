<?php

namespace App\Service;

use App\Models\User;

class UsersService {
    public function getAllUsers()
    {
        $users = User::with('galleries')->get();

        return response()->json([
            'status' => 'success',
            'users' => $users,
        ]);
    }

    public function getUserById(string $id)
    {
        $user = User::with('galleries')->find($id);
        return response()->json([
            'user' => $user,
        ]);

        return $user;
    }
}