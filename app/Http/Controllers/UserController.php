<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getUser(Request $request) : JsonResponse
    {
        return response()->json($request->user());
    }
}
