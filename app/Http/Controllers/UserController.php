<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $users = User::all();
        return $this->handleResponse(UserResource::collection($users), 'Users have been retrieved!');
    }


    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'details' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }
        $user = User::create($input);
        return $this->handleResponse(new UserResource($user), 'UserResource created!');
    }


    public function show($id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);
        if (is_null($user)) {
            return $this->handleError('UserResource not found!');
        }
        return $this->handleResponse(new UserResource($user), 'UserResource retrieved.');
    }


    public function update(Request $request, User $user): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'details' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $user->name = $input['name'];
        $user->details = $input['details'];
        $user->save();

        return $this->handleResponse(new UserResource($user), 'UserResource successfully updated!');
    }

    public function destroy(User $user): \Illuminate\Http\JsonResponse
    {
        $user->delete();
        return $this->handleResponse([], 'UserResource deleted!');
    }
}
