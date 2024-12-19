<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\ResponseTrait;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use ResponseTrait;

    public function index()
    {
        $users = User::all();
        return $this->successResponse('Users retrieved successfully', $users);
    }


    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return $this->successResponse('User created successfully', $user, 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->successResponse('User retrieved successfully', $user);
    }
}
