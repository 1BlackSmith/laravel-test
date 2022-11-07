<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CreatePostsEndpoint extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required'],
            'text' => ['required'],
        ]);

        $post = new Post($data);
        $post->user_id = $request->user()->id;
        $post->save();

        return response()->json($post->toArray());
    }
}
