<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function get(Request $request, User $user)
    {
        return UserResource::make($user);
    }

    public function authorized(Request $request)
    {
        return UserResource::make($request->user());
    }
}
