<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostLikes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['like_count'] = 0;
        $validatedData["user_id"] = auth('sanctum')->user()->id;
        $post = Post::create($validatedData);
        return new PostResource($post);
    }

    public function like(Post $post)
    {
        $user = auth('sanctum')->user();

        $postLike = PostLikes::where('post_id', $post->id)->where('user_id', $user->id)->first();

        if ($postLike != null) {
            $postLike->delete();
            $post->like_count--;
            $post->save();
            return response(null, 200);
        }

        $postLikeCreate = PostLikes::create([
            'post_id' => $post->id,
            'user_id' => $user->id
        ]);
        $postLikeCreate->save();

        $post->like_count++;
        $post->save();

        return response(null, 200);
    }

    public function destroy(Post $post)
    {
        // $user = auth('sanctum')->user();
        // $response = Gate::inspect('delete', $user, $post);

        // if (!$response->allowed()) {
        //     return response(null, 403);
        // }

        $post->delete();
        return response(null, 204);
    }

    public function getAllByUser()
    {
        $user = auth('sanctum')->user();
        $posts = Post::where('user_id', $user->id)->with('book')->with('user:id,name,profile_image')->get();

        return PostResource::collection($posts);
    }
}
