<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserFriendsResource;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function show(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();
        if (is_null($user)) {
            return $this->handleError('UserResource not found!');
        }
        return $this->handleResponse(new UserResource($user), 'UserResource retrieved.');
    }


    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();
        $input = $request->all();

        $user->user_name = $input['user_name'];
        $user->save();

        return $this->handleResponse(new UserResource($user), 'UserResource successfully updated!');
    }

    public function get_friends(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();
        if (is_null($user)) {
            return $this->handleError('UserResource not found!');
        }
        $friends = $user->friends->sortByDesc(function ($friend) {
            return $friend->scores?->sum('score');
        });
        return $this->handleResponse(UserResource::collection($friends), 'UserFriendsResource retrieved.');
    }

    public function update_friends(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();
        $input = $request->all();

        $friend_id = $input['id'];
        if ($friend_id == $user->id) {
            return $this->handleError('You can not add yourself as friend.');
        }
        $user->friends()->attach([$friend_id]);
        $friends = $user->friends->sortByDesc(function ($friend) {
            return $friend->scores?->sum('score');
        });
        return $this->handleResponse(UserResource::collection($friends), 'UserFriendsResource successfully updated!');
    }

    public function update_scores(Request $request, $destination_user_id): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $source_user = $request->user();
        $score = $input['score'];

        Score::create([
            'source_id' => $source_user->id,
            'user_id' => $destination_user_id,
            'score' => $score
        ]);
        return $this->handleResponse([], 'UserFriendsResource successfully updated!');
    }
}
