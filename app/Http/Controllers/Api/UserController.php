<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        try {
            $perPage = $request->per_page ?? 10;

            $query = User::where('is_active', 1);

            $this->_searchFilter($query, $request);
            $this->_sortQuery($query, $request);

            $users = $query->paginate($perPage);
            $paginateData =  $this->paginationResource($users, 'users');

            return $this->successResponse('Users retrieved successfully', $paginateData);
        } catch (\Throwable $e) {
            Log::error('Error in index method: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return $this->errorResponse('Failed to retrieve users');
        }
    }


    public function store(UserRequest $request)
    {
        try {
            $validated = $request->validated();

            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return $this->successResponse('User created successfully', $user, 201);
        } catch (\Throwable $e) {
            Log::error('Error in store method: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return $this->errorResponse('Failed to create user');
        }
    }

    public function show($id)
    {
        try {
            $user = User::where('is_active', 1)->findOrFail($id);

            return $this->successResponse('User retrieved successfully', $user);
        } catch (\Throwable $e) {
            Log::error('Error in show method: ' . $e->getMessage(), ['id' => $id, 'trace' => $e->getTrace()]);
            return $this->errorResponse('User not found', null, 404);
        }
    }

    private function _searchFilter($query, $request)
    {
        if ($request->filled('search')) {
            $searchPreSubFix = '%' . strtolower($request->search) . '%';
            $query->where(function ($query) use ($searchPreSubFix) {
                $query->whereRaw('LOWER(name) LIKE ?', [$searchPreSubFix])
                    ->orWhereRaw('LOWER(email) LIKE ?', [$searchPreSubFix]);
            });
        }
    }

    private function _sortQuery($query, $request)
    {
        $sortBy = ($request->filled('sortBy') && in_array($request->sortBy, ['name', 'email', 'created_at']))
            ? $request->sortBy
            : 'created_at';
        $sortDir = ($request->filled('sortDir') && in_array($request->sortDir, ['asc', 'desc']))
            ? $request->sortDir
            : 'asc';

        $query->orderBy($sortBy, $sortDir);
    }
}
