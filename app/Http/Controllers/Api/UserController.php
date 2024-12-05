<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserFollowing;
use App\Models\User;
use App\Models\UserFollower;

class UserController extends Controller
{
    public function getUserImage()
    {
        $user = auth('sanctum')->user();

        return response()->json([
            'image' => $user->profile_image
        ]);
    }

    public function followUser(StoreUserFollowing $request)
    {
        $user = auth('sanctum')->user();

        $data = $request->validated();
        $data['follower_id'] = $user->id;

        if (UserFollower::where('user_id', $user->id)->where('follower_id', $data['follower_id'])->exists()) {
            return response(null, 200);
        }

        UserFollower::create($data);
        $user->followers_count++;

        $user = User::where('id', $data['user_id'])->first();
        $user->followers_count++;
        $user->save();

        return response(null, 201);
    }

    public function getFollowingAndFollowers()
    {
        $user = auth('sanctum')->user();

        $followers = UserFollower::where('user_id', $user->id)->count();

        return response()->json([
            'following' => $followers,
            'followers' => $user->followers_count
        ]);
    }
}
