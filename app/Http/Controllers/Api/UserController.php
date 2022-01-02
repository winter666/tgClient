<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get(Request $request, $id) {
        try {
            $user = User::findOrFail($id);
            return response()->json(['attachments' => ['user' => $user]]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Resource not found'], 400);
        }
    }

    public function getCurrent(Request $request)
    {
        try {
            $user = $request->user();
            return response()->json(['attachments' => ['user' => $user]]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Resource not found'], 400);
        }
    }
}
