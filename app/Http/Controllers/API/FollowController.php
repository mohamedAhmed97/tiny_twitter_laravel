<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\FollowResource;
class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function store(Request $request, $id)
    {
        $user = $request->user();
        User::findOrFail($user->id)->followers()->attach(User::findOrFail($id));
        return new FollowResource(User::findOrFail($id));
    }
}
