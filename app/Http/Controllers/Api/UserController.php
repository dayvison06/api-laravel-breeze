<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $users = User::all();
        return UserResource::collection($users);

    }

    public function store(Request $request)
    {
        // Pega todos os dados que vem no corpo da requisição
        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        return new UserResource($user);

    }
}
