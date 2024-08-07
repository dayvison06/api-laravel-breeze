<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
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

    public function store(StoreUpdateUserRequest $request)
    {
        // Pega todos os dados que vem no corpo da requisição
        $data = $request->validated();

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        return new UserResource($user);

    }

    public function show(string $id)
    {
        // $user = User::find($id);

        // if (!$user){
        //     return response()->json(['message' => 'user not found'], 404);
        // }

        $user = User::findOrFail($id);

        return new UserResource($user);

    }

    public function update(Request $request, string $id)
    {

        $user = User::findOrFail($id);

        $data = $request->all();

        if ($request->password):
            $data['password'] = bcrypt($request->password);
        endif;

        $user->update($data);

        return new UserResource($user);
    }

    public function destroy(string $id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([], 204);
    }
}
