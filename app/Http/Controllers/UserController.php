<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Request\StoreUserRequest;


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
}
