<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    //
    public function index()
    {

        $users = User::paginate(10);

        return new UserCollection($users);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request)
    {
        //
        return new UserResource(User::create($request->all())); 
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        //
        if (!Gate::allows('update-user', $user)) {
            return response()->json(['error' => 'User unauthorized to perform this action.'], 403);
        }

        $user->update($request->all());

        return response()->json(['message' => 'User updated successfully'], 200);
    }

    public function destroy(User $user)
    {
        // Delete user 
        if (!Gate::allows('delete-user', $user)) {
            return response()->json(['error' => 'User unauthorized to perform this action.'], 403);
        }

        $user->delete();

        // Return a response indicating success
        return response()->json(['message' => 'User deleted successfully'], 200);
        
    }
}
