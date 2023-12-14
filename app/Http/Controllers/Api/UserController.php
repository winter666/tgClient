<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get(Request $request, $id)
    {
        try {
            return UserResource::make(
                User::query()->findOrFail($id)
            );
        } catch (\Exception $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
    }

    public function authorized(Request $request)
    {
        try {
            return UserResource::make($request->user());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
    }
}
